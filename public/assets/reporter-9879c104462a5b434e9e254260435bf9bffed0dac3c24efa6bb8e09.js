var reporter={setReportableType:function(e){this.reportableType=e},events:{annotationReporterShown:"annotationReporterShown"},init:function(){_this=this,_this.reporter=$("#reporter_modal"),_this.reportable={},_this.initReporterValidation(),_this.reporter.find(".modal-body").slimScroll({height:"100%",railVisible:!0,alwaysVisible:!0,position:"left"}),$("#reporter_modal:not(.bound)").addClass("bound").on("submit",_this.reportAnnotation),$("#reporter_modal .reporter-cancel:not(.bound)").addClass("bound").on("click",_this.hideReporter),"topic_reference"==_this.reportableType&&$(document).on("click",".L_report_Topic",_this.topicReferenceReporterShown)},pluginInit:function(){this.init()},annotationReporterShown:function(e){_this.reportable=e,_this.showReporter()},topicReferenceReporterShown:function(e){_this.reportableItem=$(this),_this.reportable.id=$(this).data("id"),_this.showReporter()},showReporter:function(){_this.reporter.modal("show"),_this.reporter.find('textarea[name="report_description"]').val("")},initReporterValidation:function(){var e={report_description:{minlength:5,required:!0}},t={report_description:{required:"\u064a\u062c\u0628 \u0625\u062f\u062e\u0627\u0644 \u0646\u0635 \u0627\u0644\u0625\u0628\u0644\u0627\u063a",minlength:"\u064a\u062c\u0628 \u0623\u0646 \u0644\u0627 \u064a\u0642\u0644 \u0639\u0646 5 \u0623\u062d\u0631\u0641"}};_this.validator=_this.reporter.find("form").validate({rules:e,messages:t})},hideReporter:function(){_this.validator.resetForm(),_this.reporter.modal("hide")},reportAnnotation:function(e){e.preventDefault();var t=_this.reporter.find('textarea[name="report_description"]').val();_this.reportable.reported=!0,_this.reportable.report_description=t,"annotation"==_this.reportableType?_this.annotator.publish("annotationReported",[$.extend(_this.reportable,{report_description:t})]):"topic_reference"==_this.reportableType&&_this.reportTopicReference(),_this.hideReporter()},reportTopicReference:function(){$.ajax({url:"/topic_references/"+_this.reportable.id+"/report",type:"PUT",data:_this.reportable,success:function(){showFlash("success","\u062a\u0645 \u0627\u0644\u0625\u0628\u0644\u0627\u063a \u0639\u0646 \u0627\u0644\u0645\u062d\u062a\u0648\u0649 \u0628\u0646\u062c\u0627\u062d, \u0633\u064a\u062a\u0645 \u0645\u0631\u0627\u062c\u0639\u0629 \u0625\u0628\u0644\u0627\u063a\u0643 \u0645\u0646 \u0642\u0628\u0644 \u0627\u0644\u0645\u062e\u062a\u0635."),_this.addReportIndicator()},error:function(){showFlash("error","\u062d\u062f\u062b \u062e\u0637\u0623. \u0628\u0631\u062c\u0627\u0621 \u0627\u0644\u0645\u062d\u0627\u0648\u0644\u0649 \u0645\u0631\u0629 \u0623\u062e\u0631\u0649 \u0644\u0627\u062d\u0642\u0627.")}})},addReportIndicator:function(){reportIndicatorPlace=$(_this.reportableItem).closest(".reference-wrapper").find(".reported-placeholder"),0==reportIndicatorPlace.find("i").length&&reportIndicatorPlace.html('<span class="reported"><i data-toggle="tooltip" data-placement="top" title="\u0644\u0642\u062f \u0642\u0645\u062a \u0628\u0627\u0644\u0625\u0628\u0644\u0627\u063a \u0639\u0646 \u0647\u0630\u0627 \u0627\u0644\u0645\u062d\u062a\u0648\u0649 \u0645\u0633\u0628\u0642\u0627" class="fa fa-flag" container= "body"></i></span>')}};