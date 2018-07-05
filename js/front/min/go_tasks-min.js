function getTimeRemaining(e){var r=Date.parse(e)-Date.parse(new Date),t=Math.floor(r/1e3%60),o=Math.floor(r/1e3/60%60),a=Math.floor(r/36e5%24);return{total:r,days:Math.floor(r/864e5),hours:a,minutes:o,seconds:t}}function initializeClock(e,r){function t(){var e=getTimeRemaining(r);if(e.days=Math.max(0,e.days),a.innerHTML=e.days,e.hours=Math.max(0,e.hours),s.innerHTML=("0"+e.hours).slice(-2),e.minutes=Math.max(0,e.minutes),_.innerHTML=("0"+e.minutes).slice(-2),e.seconds=Math.max(0,e.seconds),n.innerHTML=("0"+e.seconds).slice(-2),e.total=0){clearInterval(u);new Audio(PluginDir.url+"media/airhorn.mp3").play()}}var o=document.getElementById(e),a=o.querySelector(".days"),s=o.querySelector(".hours"),_=o.querySelector(".minutes"),n=o.querySelector(".seconds");t();var i=getTimeRemaining(r),g=i.total;if(console.log(i.total),g>0)var u=setInterval(t,1e3)}function go_timer_abandon(){var e=go_task_data.redirectURL;window.location=e}function flash_error_msg(e){var r=jQuery(e).css("background-color");void 0===typeof r&&(r="white"),jQuery(e).animate({color:r},200,function(){jQuery(e).animate({color:"red"},200)})}function go_enable_loading(e){e.innerHTML='<span class="go_loading"></span>'+e.innerHTML}function go_disable_loading(){console.log("oneclick"),jQuery(".go_loading").remove(),jQuery("#go_button").off().one("click",function(e){task_stage_check_input(this)}),jQuery("#go_back_button").off().one("click",function(e){task_stage_check_input(this)})}function task_stage_check_input(e){console.log("button clicked"),go_enable_loading(e);var r="";void 0!==jQuery(e).attr("button_type")&&(r=jQuery(e).attr("button_type"));var t="";void 0!==jQuery(e).attr("status")&&(t=jQuery(e).attr("status"));var o="";if(void 0!==jQuery(e).attr("check_type")&&(o=jQuery(e).attr("check_type")),"continue"==r||"complete"==r||"continue_bonus"==r||"complete_bonus"==r)if("password"===o||"unlock"==o){var a=jQuery("#go_result").attr("value").length>0;if(!a){jQuery("#go_stage_error_msg").show();var s="Retrieve the password from "+go_task_data.admin_name+".";return jQuery("#go_stage_error_msg").text()!=s?jQuery("#go_stage_error_msg").text(s):flash_error_msg("#go_stage_error_msg"),void go_disable_loading()}}else if("URL"==o){var _=jQuery("#go_result").attr("value").replace(/\s+/,"");if(!(_.length>0)){jQuery("#go_stage_error_msg").show();var s="Enter a valid URL.";return jQuery("#go_stage_error_msg").text()!=s?jQuery("#go_stage_error_msg").text(s):flash_error_msg("#go_stage_error_msg"),void go_disable_loading()}if(!_.match(/^(http:\/\/|https:\/\/).*\..*$/)||_.lastIndexOf("http://")>0||_.lastIndexOf("https://")>0){jQuery("#go_stage_error_msg").show();var s="Enter a valid URL.";return jQuery("#go_stage_error_msg").text()!=s?jQuery("#go_stage_error_msg").text(s):flash_error_msg("#go_stage_error_msg"),void go_disable_loading()}var n=!0}else if("upload"==o){var i=jQuery("#go_result").attr("value");if(void 0==i){jQuery("#go_stage_error_msg").show();var s="Please attach a file.";return jQuery("#go_stage_error_msg").text()!=s?jQuery("#go_stage_error_msg").text(s):flash_error_msg("#go_stage_error_msg"),void go_disable_loading()}}else if("quiz"==o){var g=jQuery(".go_test_list");if(g.length>=1){for(var u=0,l=0;l<g.length;l++){var c="#"+g[l].id+" input:checked",d=jQuery(c);d.length>=1&&u++}return u>=g.length?(go_quiz_check_answers(t,e),void go_disable_loading()):g.length>1?(jQuery("#go_stage_error_msg").show(),"Please answer all questions!"!=jQuery("#go_stage_error_msg").text()?jQuery("#go_stage_error_msg").text("Please answer all questions!"):flash_error_msg("#go_stage_error_msg"),void go_disable_loading()):(jQuery("#go_stage_error_msg").show(),"Please answer the question!"!=jQuery("#go_stage_error_msg").text()?jQuery("#go_stage_error_msg").text("Please answer the question!"):flash_error_msg("#go_stage_error_msg"),void go_disable_loading())}}task_stage_change(e)}function task_stage_change(e){console.log("change");var r="";void 0!==jQuery(e).attr("button_type")&&(r=jQuery(e).attr("button_type"));var t="";void 0!==jQuery(e).attr("status")&&(t=jQuery(e).attr("status"));var o="";void 0!==jQuery(e).attr("check_type")&&(o=jQuery(e).attr("check_type"));var a=jQuery("#go_admin_bar_progress_bar").css("background-color"),s=jQuery("#go_result").attr("value");jQuery.ajax({type:"POST",data:{_ajax_nonce:go_task_data.go_task_change_stage,action:"go_task_change_stage",post_id:go_task_data.ID,user_id:go_task_data.userID,status:t,button_type:r,check_type:o,result:s},success:function(e){console.log("success");var r={};try{var r=JSON.parse(e)}catch(e){r={json_status:"101",timer_start:"",button_type:"",time_left:"",html:"",redirect:"",rewards:{gold:0}}}if("101"===Number.parseInt(r.json_status)){console.log(101),jQuery("#go_stage_error_msg").show();var t="Server Error.";jQuery("#go_stage_error_msg").text()!=t?jQuery("#go_stage_error_msg").text(t):flash_error_msg("#go_stage_error_msg")}else if(302===Number.parseInt(r.json_status))console.log(302),window.location=r.location;else if("refresh"==r.json_status)location.reload();else if("bad_password"==r.json_status){jQuery("#go_stage_error_msg").show();var t="Invalid password.";jQuery("#go_stage_error_msg").text()!=t?jQuery("#go_stage_error_msg").text(t):flash_error_msg("#go_stage_error_msg")}else{if("undo"==r.button_type)jQuery("#go_wrapper div").last().hide(),jQuery("#go_wrapper > div").slice(-3).hide("slow",function(){jQuery(this).remove()});else if("undo_last"==r.button_type)jQuery("#go_wrapper div").last().hide(),jQuery("#go_wrapper > div").slice(-2).hide("slow",function(){jQuery(this).remove()});else if("continue"==r.button_type)jQuery("#go_wrapper > div").slice(-1).hide("slow",function(){jQuery(this).remove()});else if("complete"==r.button_type)jQuery("#go_wrapper > div").slice(-1).hide("slow",function(){jQuery(this).remove()});else if("show_bonus"==r.button_type)jQuery("#go_buttons").remove();else if("continue_bonus"==r.button_type)jQuery("#go_wrapper > div").slice(-1).hide("slow",function(){jQuery(this).remove()});else if("complete_bonus"==r.button_type)jQuery("#go_wrapper > div").slice(-1).hide("slow",function(){jQuery(this).remove()});else if("undo_bonus"==r.button_type)jQuery("#go_wrapper > div").slice(-2).hide("slow",function(){jQuery(this).remove()});else if("abandon_bonus"==r.button_type)jQuery("#go_wrapper > div").slice(-3).remove();else if("abandon"==r.button_type)window.location=r.redirect;else if("timer"==r.button_type){jQuery("#go_wrapper > div").slice(-2).hide("slow",function(){jQuery(this).remove()});var o=new Audio(PluginDir.url+"media/airhorn.mp3");o.play()}go_append(r),jQuery("#notification").html(r.notification),jQuery("#go_admin_bar_progress_bar").css({"background-color":a}),jQuery("#go_button").ready(function(){})}}})}function go_append(e){jQuery(e.html).appendTo("#go_wrapper").stop().show("slow").promise().then(function(){Vids_Fit_and_Box(),go_make_clickable(),go_disable_loading()})}function go_make_clickable(){jQuery(".clickable").keyup(function(e){13===e.which&&jQuery("#go_button").click()})}function go_update_admin_view(e){jQuery.ajax({type:"POST",url:MyAjax.ajaxurl,data:{_ajax_nonce:GO_EVERY_PAGE_DATA.nonces.go_update_admin_view,action:"go_update_admin_view",go_admin_view:e},success:function(e){location.reload()},error:function(e){console.log(e),console.log("fail")}})}function go_quiz_check_answers(e,r){var t=jQuery(".go_test_list"),o=t.length;if(jQuery(".go_test_list :checked").length>=o){var a=[];if(jQuery(".go_test_list").length>1){for(var s=[],_=0;_<o;_++){var n=t[_].children[1].children[0].type;a.push(n);var i="#"+t[_].id+" :checked",g=jQuery(i);if("radio"==n)void 0!=g[0]&&s.push(g[0].value);else if("checkbox"==n){for(var u=[],l=0;l<g.length;l++)u.push(g[l].value);var c=u.join("### ");s.push(c)}}var d=s.join("#### "),y=a.join("### ")}else{var h=jQuery(".go_test_list li input:checked"),y=jQuery(".go_test_list li input").first().attr("type");if("radio"==y)var d=h[0].value;else if("checkbox"==y){for(var d=[],l=0;l<h.length;l++)d.push(h[l].value);d=d.join("### ")}}}jQuery.ajax({type:"POST",data:{_ajax_nonce:go_task_data.go_unlock_stage,action:"go_unlock_stage",task_id:go_task_data.ID,user_id:go_task_data.userID,list_size:o,chosen_answer:d,type:y,status:e},success:function(e){if("refresh"==e)location.reload();else{if(1==e)return jQuery(".go_test_container").hide("slow"),jQuery("#test_failure_msg").hide("slow"),jQuery(".go_test_submit_div").hide("slow"),jQuery(".go_wrong_answer_marker").hide(),jQuery("#go_stage_error_msg").hide(),task_stage_change(r),0;if(0==e)return jQuery("#go_stage_error_msg").show(),jQuery("#go_stage_error_msg").text("Wrong answer, try again!"),1;if("string"==typeof e&&o>1){for(var a=e.split(", "),s=0;s<t.length;s++){var _="#"+t[s].id;-1===jQuery.inArray(_,a)?(jQuery(_+" .go_wrong_answer_marker").is(":visible")&&jQuery(_+" .go_wrong_answer_marker").hide(),jQuery(_+" .go_correct_answer_marker").is(":visible")||jQuery(_+" .go_correct_answer_marker").show()):(jQuery(_+" .go_correct_answer_marker").is(":visible")&&jQuery(_+" .go_correct_answer_marker").hide(),jQuery(_+" .go_wrong_answer_marker").is(":visible")||jQuery(_+" .go_wrong_answer_marker").show())}return void("Wrong answer, try again!"!=jQuery("#go_stage_error_msg").text()?(jQuery("#go_stage_error_msg").show(),jQuery("#go_stage_error_msg").text("Wrong answer, try again!")):flash_error_msg("#go_stage_error_msg"))}}}})}jQuery(document).ready(function(){jQuery.ajaxSetup({url:go_task_data.url+="/wp-admin/admin-ajax.php"});var e=go_task_data.status,r=go_task_data.currency;0===e&&r>0&&go_sounds("store"),go_make_clickable(),jQuery(".go_stage_message").show("slow"),jQuery(".go_checks_and_buttons").show("slow"),jQuery("#go_button").one("click",function(e){task_stage_check_input(this)}),jQuery("#go_back_button").one("click",function(e){task_stage_check_input(this)})});