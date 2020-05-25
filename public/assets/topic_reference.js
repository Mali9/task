//= require jquery.validate
//= require jquery.validate.additional-methods

var ready = function (){
  // Reportar Initialization
  //reporter.setReportableType("topic_reference");
  //reporter.init();

  var removeClientSideErrors = function(selector) {
    var parent = $(selector).parent();
    if(parent.hasClass('has-error')) {
      parent.children().each(function(e){
        $(this).insertBefore(parent);
      });
      parent.parent().find('.field_has_errors').remove();
      parent.remove();
    }
  }

  var addClientSideErrors = function(element, message) {
    var parent = element.parent();
    if(!parent.hasClass('has-error')) {
      parent.wrapInner("<div class='has-error'></div>");
      parent.find('.has-error').append($('#clientsidevalidations_error_template').tmpl({target: element.attr('id'), message: message}));
    }
  }

  $('#topics-tree').jstree({
    "core" : {
      "check_callback" : function(operation, node, node_parent, node_position, more) {
        // operation can be 'create_node', 'rename_node', 'delete_node', 'move_node' or 'copy_node'
        // in case of 'rename_node' node_position is filled with the new node name
        if (operation === "move_node") {
            return node_parent.children.length > 0 || node_parent.data.tr_count == 0 // && node.parent == node_parent.id Add this if you need to limit drag and drop in the same root only
        }
      },
      "multiple": false
    },
    "search": {
      "show_only_matches": true,
      "show_only_matches_children": true
    },
    "dnd": {
      drop_check: function (data) { return true; },
    },
    "plugins" : tree_plugins // this variable defined on topic index page based on condition
  });

  function get_node_name(node){
    if(node.id == '#'){
      return 'المستوي الأول'
    }else {
      return node.data.name
    }
  }

  $('#topics-tree').bind("move_node.jstree", function (e, data) {
    // drop finish
    var old_parent = data.old_parent
    var old_position = data.old_position
    var new_parent = data.parent
    var new_position = data.position
    var category_id = data.node.id

    if(old_position != new_position || new_parent != old_parent){
      if(old_parent == new_parent){
        updateCategoryOrder(old_parent, old_position, new_parent, new_position, category_id)
      }else {
        var node_name = get_node_name(data.node)
        var old_parent_node = $('#topics-tree').jstree('get_node',old_parent)
        var new_parent_node = $('#topics-tree').jstree('get_node',new_parent)
        var old_parent_name = get_node_name(old_parent_node)
        var new_parent_name = get_node_name(new_parent_node)
        var msg = "هل انت متأكد من نقل <b>" + node_name + '</b> من <b>' + old_parent_name + '</b> إلي <b>'+ new_parent_name + '</b>'
        swal(
              {
                title: " ",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                animation: "slide-from-top",
                html: true
              },function(isConfirm){
                if(isConfirm){
                  updateCategoryOrder(old_parent, old_position, new_parent, new_position, category_id)
                  updateCounts(old_parent_node);
                  updateCounts(new_parent_node);
                }else {
                  $('#topics-tree').jstree('move_node',data.node, old_parent, old_position)
                }
              }
        );
      }
    }
  }).on('search.jstree', function (nodes, str, res) {
    if (str.nodes.length === 0) {
      displayNoResults(true);
    }
  });

  var updateCounts = function(parent){
    while(parent.id != '#'){
      var count = recalcNodeCount(parent);
      $('#topics-tree').jstree('rename_node', parent ,parent.text.split('(')[0] +"(" + count +")</span>")
      $('#topics-tree').jstree('get_node',parent).data.tr_count = count
      parent = $('#topics-tree').jstree('get_node',parent.parent)
    }
  }

  var recalcNodeCount = function(node){
    var count = 0;
    node.children.forEach(function(child_id){
      child = $('#topics-tree').jstree('get_node',child_id)
      count += child.data.tr_count;
    });
    return count;
  }
  var updateCategoryOrder = function(old_parent, old_position, new_parent, new_position, category_id) {
    $.ajax({
        url: '/categories/'+category_id+'/move_node',
        data: {
          old_parent: old_parent,
          old_position: old_position,
          new_parent: new_parent,
          new_position: new_position,
          category_id: category_id,
        },
        success: function(data) {
          if(!data.saved){
            swal({
              title: ' ',
              text: "عذرا حدث خطا،  نرجو إعاده تحميل الصفحة",
              showConfirmButton: false,
            });
          }
        }
    }).fail(function(e) {
      swal({
        title: ' ',
        text: "عذرا حدث خطا،  نرجو إعاده تحميل الصفحة",
        showConfirmButton: false,
      });
    });
  }

  var displayNoResults = function(display_flag){
    if(display_flag){ // no results case
      $('#topics-tree').jstree(true).hide_all();
      $('#search_no_results').show();
    }else{ // reset initial state
      $('#search_no_results').hide();
      $('#topics-tree').jstree(true).show_all();
    }
  };

  var timeoutID       = false;
  var minSearchLength = 3;
  $('#search_input').keyup(function (event) {

    if(event.keyCode === 13) {
      if(timeoutID) {
        clearTimeout(timeoutID);
      }

      timeoutID = setTimeout(function () {
        var value = $('#search_input').val();

        if(value === "") {
          $('#topics-tree').jstree(true).clear_search();
          $('#search_hint').hide();
          displayNoResults(false);
        }
        else if(value.length < minSearchLength) {
          $('#search_hint').show();
        }
        else {
          $('#search_hint').hide();
          displayNoResults(false);
          $('#topics-tree').jstree(true).search(value);
        }
      }, 100);
    }
  });

  $('#topics-tree').on("changed.jstree", function (e, data) {
    if(data.action == 'select_node' && data.selected.length > 0) {
      if(data.node.children.length  == 0){
        $.when($("body, html").animate({ scrollTop: 0 }, "fast")).done(function(){
          $("#L_category_zero_state").hide();
          $(".topic-wrapper").show();
          $("#category_topic_loader").show();
          $(".topic-wrapper li:not(.zero-state)").remove();
          $(".topic-wrapper li.zero-state").hide();
          $.ajax({
            url: '/topic_references/category_topic_references.json',
            data: {value: data.selected[0]},
            success: function(data) {
              $("#category_topic_loader").hide();
              if(data.length == 0){
                $(".topic-wrapper li.zero-state").show();
                $("#L_change_display").hide();
              }else {
                $("#L_change_display").show();
                $(".topic-wrapper li.zero-state").hide();
              }
              $.template( "topicReferences", $("#topic_references").html() );
              $.tmpl("topicReferences", data ).appendTo("#L_topics_references_list");
              $("#L_selected-topic-header").html($.jstree.reference('#topics-tree').get_selected("full")[0].text);
              $('.L-truncate').jTruncate({
                length: 300,
                minTrail: 0,
                moreText: "+ عرض الكل",
                lessText: "- إخفاء",
                ellipsisText: " ...",
                moreAni: "fast",
                lessAni: "fast",
                collapseAll: true
              });
            }
          })
        })

      } else {
        $(this).jstree('deselect_node', data.node);
        $(this).jstree('open_node', data.node);
      }
    }
  });

  $('#topics-tree').on("ready.jstree", function (e, data) {
    $('.preloader').hide();
    $('#topics-tree').show();
    $('#search_input').attr('disabled', false);
  });

  $('body').on('shown.bs.modal', '#newTopicModal, #editTopicModal', function(){
    $('form#new_topic_reference, form.edit_topic_reference').enableClientSideValidations();
  });

  $("#newTopicModal").on('show.bs.modal', function () {
    var selected = $.jstree.reference('#topics-tree').get_selected("full")[0];
    $("#newTopicModal #topic_reference_category_id").val(selected.id);
    $("#newTopicModal #L_category_name").html(selected.text);
    $("#newTopicModal #books_category").trigger('change');
  });

  $('body').on('hidden.bs.modal', '#newTopicModal', function(){
    $("#new_topic_reference").trigger('reset');
    $("#new_topic_reference").resetClientSideValidations();
    $('#newTopicModal #books_category').val($('#books_category option:first-child').val())
    $("#newTopicModal #books_category").trigger('change');
  });

  $("#books_category").select2();

  $('body').on("change","#books_category", function(e) {
    var selected     = $(this).val();
    var form         = $(this).parents('form:first');
    var blank_option = {id: "", text: 'اختر عنوان المرجع'};

    if(selected === '') {
      $(form).find("#topic_reference_reference_id").prop('disabled', true);
      $(form).find("#topic_reference_reference_id").select2("destroy").empty();
      $(form).find("#topic_reference_reference_id").select2({data: [blank_option]});
    }
    else {

      removeClientSideErrors('#books_category');

      $.ajax({
        url: '/api/collections/references_by_category.json',
        data: {books_category_id: selected},
        success: function(data) {
          data.items.unshift(blank_option);
          $(form).find("#topic_reference_reference_id").select2("destroy").empty();
          $(form).find("#topic_reference_reference_id").select2({data: data.items});
          $("#newTopicModal #topic_reference_reference_id").prop('disabled', false);
        }
      }).fail(function(e) {
      });
    }
  });

  $('select#topic_reference_reference_id').select2();

  $('body').on('change', '#topic_reference_reference_id', function(e){
    var value = parseInt($(this).val());
    if(!isNaN(value)) {
      removeClientSideErrors('#topic_reference_reference_id');
    }
  });

  $('body').on('click','.L_edit_Topic',function(){
    $("#L_content_wrapper").html('<div class="modal-body"><div class="preloader edit_topic_reference_preloader"><i></i></div></div>')
    $.ajax({
      url: '/topic_references/'+ $(this).data('id')+ '/edit',
      success: function(data) {
        $("#L_content_wrapper").html(data)
        $("#books_category").select2();
        $('select#topic_reference_reference_id').select2();
      },
    })
  })

  $('.L-referencesContainer').on('click','.L_delete_Topic',function(){
    var self = $(this);
    swal(
      {
        title: " ",
        text: "هل انت متأكد من الحذف ؟",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "موافق",
        cancelButtonText: "إلغاء",
        animation: "slide-from-top",
        closeOnConfirm: false
      },function(){
        window.location.href = '/topic_references/'+ self.data('id')+ '/destroy';
      }
    );
    //$(".sweet-alert input[type='text']").hide();
  });

  //add slim scroll to sticky tree sidebare
  if ( $(window).width() > 700) {
    $('.L-sidebarSlimScroll').slimScroll({
      height: ($(window).height() - 65 - 50),
      position: 'left'
    });
  }

var stickySidebar = $('.L-stickySidebar');
if (stickySidebar.length > 0) {
  var stickyHeight = stickySidebar.height(),
      sidebarTop = (stickySidebar.offset().top - 10);
}

// on scroll move the sidebar
$(window).scroll(function () {
  calculate_sidebar_top();
});

var calculate_sidebar_top = function() {
  if (stickySidebar.length > 0) {
    var scrollTop = $(window).scrollTop();
    if (sidebarTop < scrollTop) {
      stickySidebar.css('top', scrollTop - sidebarTop + 61);

      // stop the sticky sidebar at the footer to avoid overlapping
      var sidebarBottom = stickySidebar.offset().top + stickyHeight,
          stickyStop = $('.L-referencesContainer').offset().top + $('.L-referencesContainer').height();
      if (stickyStop < sidebarBottom) {
        var required_value = $(document).innerHeight() - 180 - $('.L-stickySidebar').height() - 250;
        stickySidebar.css('top', required_value);
      }
    }
    else {
      stickySidebar.css('top', '0');
    }
  }
};

$(window).resize(function () {
  if (stickySidebar.length > 0) {
    stickyHeight = stickySidebar.height();
  }
});

  (function changeTreeVisibility() {
    var isVisible              = true,
        originalTreeWidth      = 100 * (parseInt($('.L-treeSidebar').css('width')) / parseInt($('.L-treeSidebar').parent().css('width'))),
        originalContainerWidth = 100 * (parseInt($('.L-referencesContainer').css('width')) / parseInt($('.L-referencesContainer').parent().css('width'))),
        originalTreeBorder     = parseInt($('.L-treeSidebar').css('border-left-width')),
        originalTreePadding    = $('.L-treeSidebar').css('padding-left'),
        arrowIcon              = $('.L-treeButton').find('i');

    $('.L-treeButton').on('click', function(event) {
      event.preventDefault();
      if ( isVisible ) {
        $('.L-treeSidebar').animate({
          width:        0,
          opacity:      0,
          height:       0,
          paddingRight: 0,
          paddingLeft:  0,
          borderWidth:  0
        }).promise().done(function() {
          $('.L-referencesContainer').animate({
            width: '100%'
          });
          $(arrowIcon).removeClass().addClass('icon-open_sidebar');
          isVisible = false;
        });
      }
      else {
        $('.L-referencesContainer').animate({
          width: originalContainerWidth + '%'
        }).promise().done(function() {
          $('.L-treeSidebar').animate({
            width:         originalTreeWidth + '%',
            opacity:       1,
            height:       '100%',
            paddingRight: originalTreePadding,
            paddingLeft:  originalTreePadding,
            borderWidth:  originalTreeBorder
          });
          $(arrowIcon).removeClass().addClass('icon-close_sidebar');
          isVisible = true;
        });
      };
    });
  })();
  if(window.location.search){
    var cat_id = window.location.search.split("?")[1].split("=")[1];
    $.jstree.reference('#topics-tree').deselect_all();
    $.jstree.reference('#topics-tree').select_node(cat_id);
  }

  $('body').on('submit', 'form#new_topic_reference, form.edit_topic_reference', function(event){
    if($(event.currentTarget).find('.has-error').length > 0) {
      return false;
    }
    else {
      $(this).find("input[type='submit']").attr('disabled', true);
    }
  });

  ClientSideValidations.callbacks.form.after = function(form, eventData) {
    if(form.attr('id') === 'new_topic_reference' || form.hasClass('edit_topic_reference')){
      var elements = [{id: 'books_category', message: 'يجب اختيار التصنيف'},
                      {id: 'topic_reference_reference_id', message: 'يجب اختيار المرجع'}];

      elements.forEach(function(obj){
        var element = $('#' + obj.id);
        var value = parseInt(element.val());

        if(isNaN(value)){
          addClientSideErrors(element, obj.message);
        }
      });
    }
  }

  $('body').tooltip({
    selector: '[data-toggle=tooltip]'
  });
}

$(document).on('ready page:load', function(){
  setTimeout(ready, 600);
});
