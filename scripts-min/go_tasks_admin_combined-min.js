function go_start_filter_on_toggle(e){var t=jQuery(e).is(":visible"),o=!1;1===jQuery(e+" #go_start_checkbox").length&&jQuery(e+" #go_start_checkbox").is(":checked")&&(o=!0);var _=jQuery(e+" #go_start_info");t?t&&jQuery(e).hide():(jQuery(e).show(),o?jQuery(_).show():jQuery(_).hide())}function go_date_picker_on_toggle(e){var t=jQuery(e).is(":visible"),o=!1;1===jQuery("#go_calendar_checkbox").length&&jQuery("#go_calendar_checkbox").is(":checked")&&(o=!0),o&&!t?jQuery(e).show():t&&jQuery(e).hide()}function go_time_modifier_on_toggle(e){var t=jQuery(e).is(":visible"),o=!1;1===jQuery("#go_future_checkbox").length&&jQuery("#go_future_checkbox").is(":checked")&&(o=!0),o&&!t?jQuery(e).show():t&&jQuery(e).hide()}function go_chain_order_on_toggle(e){var t=jQuery(e).is(":visible");GO_TASK_DATA.task_chains.in_chain&&!t?jQuery(e).show():t&&jQuery(e).hide()}function go_final_chain_message_on_toggle(e){var t=jQuery(e).is(":visible"),o=GO_TASK_DATA.task_chains.in_chain,_=GO_TASK_DATA.task_chains.is_last_in_chain;o&&_&&!t?jQuery(e).show():t&&jQuery(e).hide()}function go_optional_task_on_toggle(e){var t=jQuery(e).is(":visible");GO_TASK_DATA.task_chains.in_chain&&!t?jQuery(e).show():t&&jQuery(e).hide()}function go_admin_lock_on_toggle(e){var t=jQuery(e).is(":visible"),o=!1;1===jQuery(e+" .go_admin_lock_checkbox").length&&jQuery(e+" .go_admin_lock_checkbox").is(":checked")&&(o=!0);var _=jQuery(e+" .go_admin_lock_text");t?jQuery(e).hide():(jQuery(e).show(),o?jQuery(_).show():jQuery(_).hide())}function go_test_loot_checkbox_on_toggle(e){var t=jQuery(e).is(":visible"),o=jQuery(e).prev("tr").find('input[type="checkbox"]'),_=!1;1===o.length&&o.is(":checked")&&(_=!0),!t&&_?jQuery(e).show():t&&!_&&jQuery(e).hide()}function go_test_loot_mod_on_toggle(e){var t=jQuery(e).is(":visible"),o=jQuery(e).prev("tr"),_=o.find('input[type="checkbox"]'),i=o.prev("tr").find('input[type="checkbox"]'),a=!1;1===_.length&&_.is(":checked")&&(a=!0);var c=!1;1===i.length&&i.is(":checked")&&(c=!0),!t&&a&&c?jQuery(e).show():!t||a&&!c||jQuery(e).hide()}function go_test_field_on_toggle(e){var t=jQuery(e).is(":visible"),o=jQuery(e).go_prev_n(3,"tr").find('input[type="checkbox"]'),_=!1;1===o.length&&o.is(":checked")&&(_=!0),!t&&_?jQuery(e).show():t&&!_&&jQuery(e).hide()}function go_badge_input_on_toggle(e){var t=jQuery(e).is(":visible"),o=jQuery(e+" .go_badge_input_toggle"),_=jQuery(e+" .go_stage_badge_container"),i=!1;1===o.length&&o.is(":checked")&&(i=!0),t?jQuery(e).hide():(jQuery(e).show(),i?jQuery(_).show():jQuery(_).hide())}function go_bonus_loot_on_toggle(e){var t=jQuery(e).is(":visible"),o=jQuery(e+" #go_bonus_loot_checkbox"),_=jQuery(e+" #go_bonus_loot_wrap"),i=!1;1===o.length&&o.is(":checked")&&(i=!0),t?jQuery(e).hide():(jQuery(e).show(),i?jQuery(_).show():jQuery(_).hide())}function go_stage_four_on_load(e){var t=jQuery("#go_mta_three_stage_switch"),o=jQuery(e).siblings(".cmb_id_go_mta_mastery_message");t.length>0&&t.is(":checked")&&(o.is(":visible")&&o.hide(),jQuery(e).is(":visible")&&jQuery(e).hide())}function go_stage_five_on_load(e){var t=jQuery("#go_mta_three_stage_switch"),o=jQuery("#go_mta_five_stage_switch"),_=jQuery(e).siblings(".cmb_id_go_mta_repeat_message");o.length>0&&(!t.is(":checked")&&o.is(":checked")||(_.is(":visible")&&_.hide(),jQuery(e).is(":visible")&&jQuery(e).hide()))}function go_start_filter_on_load(e){jQuery(e.class).hide(),1===jQuery(e.class+" #go_start_checkbox").length&&jQuery(e.class+" #go_start_checkbox").change(go_start_filter_checkbox_on_change)}function go_time_filters_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" #go_calendar_checkbox, "+e.class+" #go_future_checkbox");2===t.length&&t.change(go_time_filter_checkboxes_on_change)}function go_date_picker_on_load(e){jQuery(e.class).hide();var t=jQuery("#go_calendar_checkbox"),o=jQuery(e.class+" #go_mta_add_task_decay"),_=jQuery(e.class+" #go_mta_remove_task_decay");1===t.length&&t.change(function(){go_date_picker_on_toggle(e.class)}),1===o.length&&o.click(go_date_picker_add_field),1===_.length&&_.click(go_date_picker_del_field)}function go_time_modifier_on_load(e){jQuery(e.class).hide();var t=jQuery("#go_future_checkbox");1===t.length&&t.change(function(){go_time_modifier_on_toggle(e.class)})}function go_inverted_checkbox_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" .go_inverted_checkbox");1===t.length&&t.change(go_inverted_checkbox_on_change)}function go_chain_order_on_load(e){jQuery(e.class).hide(),GO_TASK_DATA.task_chains.in_chain&&go_prepare_sortable_list()}function go_stage_reward_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" .go_reward_input");t.length>0&&jQuery(t).keyup(go_stage_reward_on_keyup)}function go_admin_lock_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" .go_admin_lock_checkbox");1===t.length&&t.change(go_admin_lock_checkbox_on_change)}function go_test_checkbox_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+' input[type="checkbox"]');1===t.length&&t.change({row_class:e.class},go_test_checkbox_on_change)}function go_test_loot_checkbox_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+' input[type="checkbox"]');1===t.length&&t.change({row_class:e.class},go_test_loot_checkbox_on_change)}function go_badge_input_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" .go_badge_input_toggle"),o=jQuery(e.class+" .go_badge_input_add"),_=jQuery(e.class+" .go_badge_input_del");1===t.length&&t.change(go_badge_input_checkbox_on_change),o.length>=1&&o.click(go_badge_input_add_field),_.length>=1&&(1==_.length&&_.hide(),_.click(go_badge_input_del_field))}function go_bonus_loot_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" #go_bonus_loot_checkbox");1===t.length&&t.change(go_bonus_loot_checkbox_on_change)}function go_three_stage_checkbox_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" #go_mta_three_stage_switch");1===t.length&&t.change(go_three_stage_checkbox_on_change)}function go_five_stage_checkbox_on_load(e){jQuery(e.class).hide();var t=jQuery(e.class+" #go_mta_five_stage_switch");1===t.length&&t.change(go_five_stage_checkbox_on_change)}function go_date_input_supported(){var e=document.createElement("input");e.type="date";var t=!1;return"date"===e.type&&(t=!0),t}function go_time_input_keypress_handler(e){var t=new RegExp("^[0-9:APM]$"),o=String.fromCharCode(e.charCode?e.charCode:e.which),_=jQuery(e.target),i=_.val();(!t.test(o)||i.length>7)&&e.preventDefault(),i.length>7&&_.val(i.substr(0,8))}function go_date_input_make_datepicker(e){var t="yy-mm-dd";jQuery(e).datepicker({dateFormat:"yy-mm-dd"})}function go_time_input_make_timepicker(e){jQuery(e).ptTimeSelect();var t=jQuery(e).val(),o,_=0,i,a,c="",n=-1;n=t.search(":"),o=parseInt(t.substring(0,n)),_=parseInt(t.substring(n+1,n+3));var r=o<12?"AM":"PM";if("PM"===r&&12!==o){var l=o-12;i=l>=10?l:"0"+(o-12)}else i="AM"===r&&0===o?"12":o;a=0===_||_<10?"0"+_:_,c=i+":"+a+" "+r,jQuery(e).val(c),jQuery(e).keypress(go_time_input_keypress_handler)}function go_date_and_time_inputs_on_load(){go_date_input_supported()||(jQuery("input.go_datepicker").length>0&&jQuery("input.go_datepicker").each(function(e,t){go_date_input_make_datepicker(t)}),jQuery("input.custom_time").length>0&&jQuery("input.custom_time").each(function(e,t){go_time_input_make_timepicker(t)}))}function go_before_publish_on_load(){jQuery("input#publish").on("click submit",go_before_task_publish_handler),jQuery("form#post").keydown(function(e){13===e.keyCode&&(e.preventDefault(),jQuery("input#publish").trigger("submit"))})}function go_start_filter_checkbox_on_change(e){var t=!1;1===jQuery(e.target).length&&jQuery(e.target).is(":checked")&&(t=!0);var o=jQuery(e.target).siblings("#go_start_info");t?o.show():o.hide()}function go_time_filter_checkboxes_on_change(e){var t=e.target,o=null,_,i=!1;1===jQuery(e.target).length&&jQuery(e.target).is(":checked")&&(_=!0),o="go_calendar_checkbox"===t.id?jQuery("#go_future_checkbox"):jQuery("#go_calendar_checkbox"),o.is(":checked")&&(i=!0),_&&i&&(o.prop("checked",""),o.trigger("change"))}function go_date_picker_add_field(){var e=document.createElement("tr"),t=document.createElement("td"),o=document.createElement("input"),_=document.createElement("span"),i=document.createElement("input");o.classList.add("go_date_picker_input","go_date_picker_calendar_input","go_datepicker","custom_date"),o.name="go_mta_task_decay_calendar[]",o.type="date",o.placeholder="Click for Date",_.innerText=" @ (hh:mm AM/PM)",i.classList.add("go_date_picker_input","go_date_picker_time_input","custom_time"),i.name="go_mta_task_decay_calendar_time[]",i.type="time",i.placeholder="Click for Time",i.value="00:00",t.appendChild(o),t.appendChild(_),t.appendChild(i);var a=document.createElement("td"),c=document.createElement("input"),n=document.createElement("span");c.classList.add("go_date_picker_input","go_date_picker_modifier_input"),c.name="go_mta_task_decay_percent[]",c.type="text",c.placeholder="Modifier",n.innerText="%",a.appendChild(c),a.appendChild(n),e.appendChild(t),e.appendChild(a),jQuery("#go_list_of_decay_dates tbody").last().append(e),go_date_input_supported()||(go_date_input_make_datepicker(o),go_time_input_make_timepicker(i))}function go_date_picker_del_field(){jQuery("#go_list_of_decay_dates tbody tr").last(".go_datepicker").remove()}function go_inverted_checkbox_on_change(e){var t=jQuery(e.target),o=t.siblings(".go_inverted_checkbox_hidden"),_=!1;t.is(":checked")&&(_=!0),t.parent().is(":visible")&&o.val(_?"true":"false")}function go_stage_reward_on_keyup(e){var t=e.target,o=jQuery(t).attr("stage"),_=jQuery(t).attr("reward"),i=t.value,a="input[stage="+o+"][reward="+_+"]";jQuery(a).not(t).val(i)}function go_admin_lock_checkbox_on_change(e){var t=e.target,o=jQuery(t).is(":checked"),_=jQuery(t).siblings(".go_admin_lock_text")[0];o?jQuery(_).is(":visible")||jQuery(_).show():jQuery(_).is(":visible")&&jQuery(_).hide()}function go_test_checkbox_on_change(e){var t=e.target,o=e.handleObj.data.row_class,_=t.id.getMid("go_mta_test_","_lock"),i=jQuery(t).is(":checked"),a=jQuery(o+" ~ tr.cmb_id_go_mta_test_"+_+"_lock_loot").first(),c=jQuery(o+" ~ tr.cmb_id_go_mta_test_"+_+"_lock_loot_mod").first(),n=jQuery(o+" ~ tr.cmb-type-go_test_field").first(),r=a.find('input[type="checkbox"]'),l=r.is(":checked");i?(a.is(":visible")||a.show(),!c.is(":visible")&&l&&c.show(),n.is(":visible")||n.show()):(a.is(":visible")&&a.hide(),c.is(":visible")&&c.hide(),n.is(":visible")&&n.hide())}function go_test_loot_checkbox_on_change(e){var t=e.target,o=e.handleObj.data.row_class,_=t.id.getMid("go_mta_test_","_lock_loot"),i=jQuery(t).is(":checked"),a=jQuery(o+" ~ tr.cmb_id_go_mta_test_"+_+"_lock_loot_mod").first(),c=a.is(":visible");i&&!c?a.show():!i&&c&&a.hide()}function go_badge_input_checkbox_on_change(e){var t=e.target,o=jQuery(t).is(":checked"),_=jQuery(t).siblings("ul.go_stage_badge_container"),i=!1;_.is(":visible")&&(i=!0),o&&!i?_.show():!o&&i&&_.hide()}function go_badge_input_add_field(e){var t=e.target,o=jQuery(t).siblings(".go_badge_input_del").eq(0),_=jQuery(t).siblings(".go_badge_input")[0],i=jQuery(t).parents().eq(1),a=jQuery(t).parents().eq(0),c=["type","name","class","stage","placeholder"],n=["type","class","value"],r=document.createElement("li");jQuery(a).after(r);var l=document.createElement("input");jQuery(r).append(l);var s=document.createElement("input");jQuery(r).append(s);var d=document.createElement("input");jQuery(r).append(d);for(var g="",u=0;u<c.length;u++)g=jQuery(_).attr(c[u]),jQuery(l).attr(c[u],g);for(var p=0;p<n.length;p++)g=jQuery(t).attr(n[p]),jQuery(s).attr(n[p],g);if(jQuery(s).click(go_badge_input_add_field),o.length>0){for(var m=0;m<n.length;m++)g=jQuery(o).attr(n[m]),jQuery(d).attr(n[m],g);jQuery(d).click(go_badge_input_del_field)}var h=i.children("li");if(h.length>0){var y=jQuery(h[0]).children(".go_badge_input_del").eq(0);y.is(":visible")||y.show()}}function go_badge_input_del_field(e){var t=e.target,o=jQuery(t).parents().eq(1),_=jQuery(t).parents().eq(0);jQuery(_).remove();var i=o.children("li");1===i.length&&jQuery(i[0]).children(".go_badge_input_del").hide()}function go_badge_input_clear_empty_fields(){var e=jQuery(".go_stage_badge_container");if(e.length>0)for(var t=0;t<e.length;t++)for(var o=jQuery(e[t]).children("li"),_=0;_<o.length;_++){var i=o[_],a=jQuery(o[_]).children(".go_badge_input")[0].value;""!==a&&0!==Number.parseInt(a)||jQuery(i).remove()}}function go_bonus_loot_checkbox_on_change(e){var t=e.target,o=jQuery(t).is(":checked"),_=jQuery(t).siblings("#go_bonus_loot_wrap"),i=!1;_.is(":visible")&&(i=!0),o&&!i?_.show():!o&&i&&_.hide()}function go_bonus_loot_validate_fields(){var e=jQuery("#go_bonus_loot_checkbox"),t=jQuery("#go_bonus_loot_wrap"),o=t.children("li").children(".go_bonus_loot_rarity"),_=t.siblings(".go_bonus_loot_rarity_range").eq(0).val(),i=/^([0-9]+\.[0-9]+|[0-9]+), ([0-9]+\.[0-9]+|[0-9]+)$/,a=[],c,n=null,r=[],l=!0;if(!e.is(":checked")||""===_||null===_.match(i))return void jQuery("input#publish").trigger("click",!0);t.children(".go_error").remove(),a=_.split(", "),c=Number.parseFloat(a[0]),n=Number.parseFloat(a[1]);for(var s=0;s<o.length;s++)try{go_bonus_loot_validate_input_val(o[s],c,n)}catch(e){r.push({index:s,error:e})}for(var d=0;d<r.length;d++){var g=r[d].index,u=r[d].error.message,p=document.createElement("li");jQuery(o).eq(g).parent().before(p),jQuery(p).addClass("go_error");var m=document.createElement("span");jQuery(p).append(m),jQuery(m).addClass("go_error_red"),jQuery(m).html(u)}r.length>0?(window.location.hash="",window.location.hash="go_bonus_loot_checkbox"):jQuery("input#publish").trigger("click",!0)}function go_bonus_loot_validate_input_val(e,t,o){if(void 0===e||void 0===t||void 0===o)throw new Error("Something went wrong! Three arguments are required for go_bonus_loot_validate_input_val().");var _=e.value;if(null!==_.match(/([^0-9\.\-]+|(\..*\.)+)/))throw new Error("The input is not a number.");var i=!1,a=Number.parseFloat(_),c=t+", "+o;if(a<t||a>o)throw new Error("The input is outside the allowed range ("+c+").")}function go_three_stage_checkbox_on_change(e){var t=e.target,o=jQuery(t).is(":checked"),_=".cmb_id_stage_four_settings",i=jQuery(_).find(".go_task_settings_accordion"),a=jQuery(_).siblings(".cmb_id_go_mta_mastery_message"),c=jQuery(_).is(":visible"),n=jQuery(i).hasClass("opened"),r=jQuery("#go_mta_five_stage_switch"),l=".cmb_id_stage_five_settings",s=jQuery(l).find(".go_task_settings_accordion"),d=jQuery(l).siblings(".cmb_id_go_mta_repeat_message"),g=jQuery(l).is(":visible"),u=jQuery(s).hasClass("opened");o&&c?(a.is(":visible")&&a.hide(),n&&i.trigger("click"),jQuery(_).hide(),g&&(d.is(":visible")&&d.hide(),u&&s.trigger("click"),jQuery(l).hide())):o||c||(a.is(":visible")||a.show(),jQuery(_).show(),r.is(":checked")&&(d.is(":visible")||d.show(),jQuery(l).show()))}function go_five_stage_checkbox_on_change(e){var t=e.target,o=jQuery(t).is(":checked"),_=".cmb_id_stage_five_settings",i=jQuery(_).find(".go_task_settings_accordion"),a=jQuery(_).siblings(".cmb_id_go_mta_repeat_message"),c=jQuery(_).is(":visible"),n=jQuery(i).hasClass("opened");o&&!c?(a.is(":visible")||a.show(),jQuery(_).show()):!o&&c&&(a.is(":visible")&&a.hide(),n&&i.trigger("click"),jQuery(_).hide())}function go_before_task_publish_handler(e,t){void 0!==t&&!0===t?go_badge_input_clear_empty_fields():(e.preventDefault(),go_bonus_loot_validate_fields())}function go_toggle_accordion(e){if(void 0!==e){jQuery(e.id).toggleClass("opened");for(var t=!!jQuery(e.id).hasClass("opened"),o=e.setting_rows,_=0;_<o.length;_++){var i=o[_],a=i.class;t?void 0!==i.on_toggle&&null!==i.on_toggle?i.on_toggle(a,t):jQuery(a).show():jQuery(a).hide()}}}function go_accordion_click_handler(e){var t={};void 0!==e.handleObj.data&&(t=e.handleObj.data,go_toggle_accordion(t.accordion_data))}function go_accordion_array_on_load(e,t){if(void 0!==e&&void 0!==t&&0!==t.length){for(var o=0;o<t.length;o++){var _=t[o],i=e[_],a=i.row_class;void 0!==i.on_load&&null!==i.on_load&&i.on_load(a),jQuery(i.id).click({accordion_data:i},go_accordion_click_handler);for(var c=i.setting_rows,n=0;n<c.length;n++){var r=c[n],l=null,s=jQuery(r.class);s.hasClass("condensed")||(s.addClass("condensed"),s.children().addClass("condensed")),void 0!==r.on_load&&null!==r.on_load?r.on_load(r):s.is(":visible")&&s.hide()}}go_date_and_time_inputs_on_load(),go_before_publish_on_load()}}function go_generate_accordion_array(){var e={advanced_task:{settings:[{cmb_type:"go_badge_input",cmb_id:"badge_filter",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle},{cmb_type:"text",cmb_id:"bonus_currency_filter"},{cmb_type:"text",cmb_id:"penalty_filter"},{cmb_type:"go_start_filter",cmb_id:"start_filter",on_load:go_start_filter_on_load,on_toggle:go_start_filter_on_toggle},{cmb_type:"go_future_filters",cmb_id:"time_filters",on_load:go_time_filters_on_load},{cmb_type:"go_decay_table",cmb_id:"date_picker",on_load:go_date_picker_on_load,on_toggle:go_date_picker_on_toggle},{cmb_type:"go_time_modifier_inputs",cmb_id:"time_modifier",on_load:go_time_modifier_on_load,on_toggle:go_time_modifier_on_toggle},{cmb_type:"checkbox",cmb_id:"focus_category_lock"},{cmb_type:"go_inverted_checkbox",cmb_id:"hide_filtered_content",on_load:go_inverted_checkbox_on_load},{cmb_type:"checkbox",cmb_id:"user_only_content"},{cmb_type:"go_task_chain_order",cmb_id:"chain_order",on_load:go_chain_order_on_load,on_toggle:go_chain_order_on_toggle},{cmb_type:"text",cmb_id:"final_chain_message",on_toggle:go_final_chain_message_on_toggle},{cmb_type:"checkbox",cmb_id:"optional_task",on_toggle:go_optional_task_on_toggle}]},stage_one:{settings:[{cmb_type:"go_stage_reward",cmb_id:"stage_one_points",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_one_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_one_bonus_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_admin_lock",cmb_id:"encounter_admin_lock",on_load:go_admin_lock_on_load,on_toggle:go_admin_lock_on_toggle},{cmb_type:"checkbox",cmb_id:"encounter_url_key"},{cmb_type:"checkbox",cmb_id:"encounter_upload"},{cmb_type:"checkbox",cmb_id:"test_encounter_lock",on_load:go_test_checkbox_on_load},{cmb_type:"checkbox",cmb_id:"test_encounter_lock_loot",on_load:go_test_loot_checkbox_on_load,on_toggle:go_test_loot_checkbox_on_toggle},{cmb_type:"go_test_modifier",cmb_id:"test_encounter_lock_loot_mod",on_toggle:go_test_loot_mod_on_toggle},{cmb_type:"go_test_field",cmb_id:"test_encounter_lock_fields",on_toggle:go_test_field_on_toggle},{cmb_type:"go_badge_input",cmb_id:"stage_one_badge",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle}]},stage_two:{settings:[{cmb_type:"go_stage_reward",cmb_id:"stage_two_points",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_two_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_two_bonus_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_admin_lock",cmb_id:"accept_admin_lock",on_load:go_admin_lock_on_load,on_toggle:go_admin_lock_on_toggle},{cmb_type:"checkbox",cmb_id:"accept_url_key"},{cmb_type:"checkbox",cmb_id:"accept_upload"},{cmb_type:"checkbox",cmb_id:"test_accept_lock",on_load:go_test_checkbox_on_load},{cmb_type:"checkbox",cmb_id:"test_accept_lock_loot",on_load:go_test_loot_checkbox_on_load,on_toggle:go_test_loot_checkbox_on_toggle},{cmb_type:"go_test_modifier",cmb_id:"test_accept_lock_loot_mod",on_toggle:go_test_loot_mod_on_toggle},{cmb_type:"go_test_field",cmb_id:"test_accept_lock_fields",on_toggle:go_test_field_on_toggle},{cmb_type:"go_badge_input",cmb_id:"stage_two_badge",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle}]},stage_three:{settings:[{cmb_type:"go_stage_reward",cmb_id:"stage_three_points",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_three_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_three_bonus_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_admin_lock",cmb_id:"completion_admin_lock",on_load:go_admin_lock_on_load,on_toggle:go_admin_lock_on_toggle},{cmb_type:"checkbox",cmb_id:"completion_url_key"},{cmb_type:"checkbox",cmb_id:"completion_upload"},{cmb_type:"checkbox",cmb_id:"test_completion_lock",on_load:go_test_checkbox_on_load},{cmb_type:"checkbox",cmb_id:"test_completion_lock_loot",on_load:go_test_loot_checkbox_on_load,on_toggle:go_test_loot_checkbox_on_toggle},{cmb_type:"go_test_modifier",cmb_id:"test_completion_lock_loot_mod",on_toggle:go_test_loot_mod_on_toggle},{cmb_type:"go_test_field",cmb_id:"test_completion_lock_fields",on_toggle:go_test_field_on_toggle},{cmb_type:"go_badge_input",cmb_id:"stage_three_badge",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle},{cmb_type:"checkbox",cmb_id:"three_stage_switch",on_load:go_three_stage_checkbox_on_load}]},stage_four:{on_load:go_stage_four_on_load,settings:[{cmb_type:"go_stage_reward",cmb_id:"stage_four_points",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_four_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_four_bonus_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_admin_lock",cmb_id:"mastery_admin_lock",on_load:go_admin_lock_on_load,on_toggle:go_admin_lock_on_toggle},{cmb_type:"checkbox",cmb_id:"mastery_upload"},{cmb_type:"checkbox",cmb_id:"test_mastery_lock",on_load:go_test_checkbox_on_load},{cmb_type:"checkbox",cmb_id:"test_mastery_lock_loot",on_load:go_test_loot_checkbox_on_load,on_toggle:go_test_loot_checkbox_on_toggle},{cmb_type:"go_test_modifier",cmb_id:"test_mastery_lock_loot_mod",on_toggle:go_test_loot_mod_on_toggle},{cmb_type:"go_test_field",cmb_id:"test_mastery_lock_fields",on_toggle:go_test_field_on_toggle},{cmb_type:"checkbox",cmb_id:"mastery_privacy"},{cmb_type:"go_badge_input",cmb_id:"stage_four_badge",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle},{cmb_type:"checkbox",cmb_id:"five_stage_switch",on_load:go_five_stage_checkbox_on_load},{cmb_type:"go_bonus_loot",cmb_id:"mastery_bonus_loot",on_load:go_bonus_loot_on_load,on_toggle:go_bonus_loot_on_toggle}]},stage_five:{on_load:go_stage_five_on_load,settings:[{cmb_type:"go_stage_reward",cmb_id:"stage_five_points",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_five_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_stage_reward",cmb_id:"stage_five_bonus_currency",on_load:go_stage_reward_on_load},{cmb_type:"go_repeat_amount",cmb_id:"repeat_amount"},{cmb_type:"go_admin_lock",cmb_id:"repeat_admin_lock",on_load:go_admin_lock_on_load,on_toggle:go_admin_lock_on_toggle},{cmb_type:"checkbox",cmb_id:"repeat_upload"},{cmb_type:"checkbox",cmb_id:"mastery_url_key"},{cmb_type:"checkbox",cmb_id:"repeat_privacy"},{cmb_type:"go_badge_input",cmb_id:"stage_five_badge",on_load:go_badge_input_on_load,on_toggle:go_badge_input_on_toggle}]}},t={};if(Object.keys(e).length>0)for(var o in e){var _=null;void 0!==e[o].on_load&&(_=e[o].on_load),t[o]={id:"#go_"+o+"_settings_accordion",row_class:"tr.cmb-type-go_settings_accordion.cmb_id_"+o+"_settings",on_load:_,setting_rows:[]};for(var i=e[o].settings,a=0;a<i.length;a++){var c=i[a],n=null;void 0!==c.on_load&&(n=c.on_load);var r=null;void 0!==c.on_toggle&&(r=c.on_toggle);var l={class:"tr.cmb-type-"+c.cmb_type+".cmb_id_go_mta_"+c.cmb_id,on_load:n,on_toggle:r};t[o].setting_rows.push(l)}}return t}function go_prepare_sortable_list(){if("undefined"!=typeof GO_TASK_DATA){var e=GO_TASK_DATA.task_id,t=GO_TASK_DATA.task_chains.in_chain;null!==e&&t&&jQuery(".go_task_chain_order_list").sortable({axis:"y",start:function(e,t){jQuery(t.item).addClass("go_sortable_item")},stop:function(e,t){jQuery(t.item).removeClass("go_sortable_item");for(var o=jQuery(t.item).parent()[0],_=[],i=go_chain_get_task_ids(o),a="",c=0;c<i.length;c++)void 0!==i[c]&&""!==i[c]&&_.push(i[c]);a=_.join(","),jQuery(o).siblings(".go_task_order_hidden").val(a)}})}}function go_chain_get_task_ids(e){var t=[];return void 0!==e&&jQuery(e).children(".go_task_in_chain").each(function(e,o){var _=jQuery(this).attr("post_id");"string"==typeof _&&(_=parseInt(_)),t[e]=_}),t}function apply_presets(){var e=jQuery("#go_presets option:selected").attr("points").split(","),t=jQuery("#go_presets option:selected").attr("currency").split(",");jQuery(".go_reward_points").each(function(){for(i=1;i<=5;i++)jQuery(".go_reward_points_"+i).val(e[i-1])}),jQuery(".go_reward_currency").each(function(){for(i=1;i<=5;i++)jQuery(".go_reward_currency_"+i).val(t[i-1])})}jQuery(document).ready(function(){var e=go_generate_accordion_array();go_accordion_array_on_load(e,Object.keys(e))}),jQuery("#go_presets").change(apply_presets),function($){jQuery.ptTimeSelect={},jQuery.ptTimeSelect.version="__BUILD_VERSION_NUMBER__",jQuery.ptTimeSelect.options={containerClass:void 0,containerWidth:"22em",hoursLabel:"Hour",minutesLabel:"Minutes",setButtonLabel:"Set",popupImage:void 0,onFocusDisplay:!0,zIndex:10,onBeforeShow:void 0,onClose:void 0},jQuery.ptTimeSelect._ptTimeSelectInit=function(){jQuery(document).ready(function(){if(!jQuery("#ptTimeSelectCntr").length){jQuery("body").append('<div id="ptTimeSelectCntr" class="">        <div class="ui-widget ui-widget-content ui-corner-all">        <div class="ui-widget-header ui-corner-all">            <div id="ptTimeSelectCloseCntr" style="float: right;">                <a href="javascript: void(0);" onclick="jQuery.ptTimeSelect.closeCntr();"                         onmouseover="jQuery(this).removeClass(\'ui-state-default\').addClass(\'ui-state-hover\');"                         onmouseout="jQuery(this).removeClass(\'ui-state-hover\').addClass(\'ui-state-default\');"                        class="ui-corner-all ui-state-default">                    <span class="ui-icon ui-icon-circle-close">X</span>                </a>            </div>            <div id="ptTimeSelectUserTime" style="float: left;">                <span id="ptTimeSelectUserSelHr">1</span> :                 <span id="ptTimeSelectUserSelMin">00</span>                 <span id="ptTimeSelectUserSelAmPm">AM</span>            </div>            <br style="clear: both;" /><div></div>        </div>        <div class="ui-widget-content ui-corner-all">            <div>                <div class="ptTimeSelectTimeLabelsCntr">                    <div class="ptTimeSelectLeftPane" style="width: 50%; text-align: center; float: left;" class="">Hour</div>                    <div class="ptTimeSelectRightPane" style="width: 50%; text-align: center; float: left;">Minutes</div>                </div>                <div>                    <div style="float: left; width: 50%;">                        <div class="ui-widget-content ptTimeSelectLeftPane">                            <div class="ptTimeSelectHrAmPmCntr">                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);"                                         style="display: block; width: 45%; float: left;">AM</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);"                                         style="display: block; width: 45%; float: left;">PM</a>                                <br style="clear: left;" /><div></div>                            </div>                            <div class="ptTimeSelectHrCntr">                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">1</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">2</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">3</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">4</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">5</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">6</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">7</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">8</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">9</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">10</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">11</a>                                <a class="ptTimeSelectHr ui-state-default" href="javascript: void(0);">12</a>                                <br style="clear: left;" /><div></div>                            </div>                        </div>                    </div>                    <div style="width: 50%; float: left;">                        <div class="ui-widget-content ptTimeSelectRightPane">                            <div class="ptTimeSelectMinCntr">                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">00</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">05</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">10</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">15</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">20</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">25</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">30</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">35</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">40</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">45</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">50</a>                                <a class="ptTimeSelectMin ui-state-default" href="javascript: void(0);">55</a>                                <br style="clear: left;" /><div></div>                            </div>                        </div>                    </div>                </div>            </div>            <div style="clear: left;"></div>        </div>        <div id="ptTimeSelectSetButton">            <a href="javascript: void(0);" onclick="jQuery.ptTimeSelect.setTime()"                    onmouseover="jQuery(this).removeClass(\'ui-state-default\').addClass(\'ui-state-hover\');"                         onmouseout="jQuery(this).removeClass(\'ui-state-hover\').addClass(\'ui-state-default\');"                        class="ui-corner-all ui-state-default">                SET            </a>            <br style="clear: both;" /><div></div>        </div>        <!--[if lte IE 6.5]>            <iframe style="display:block; position:absolute;top: 0;left:0;z-index:-1;                filter:Alpha(Opacity=\'0\');width:3000px;height:3000px"></iframe>        <![endif]-->    </div></div>');var e=jQuery("#ptTimeSelectCntr");e.find(".ptTimeSelectMin").bind("click",function(){jQuery.ptTimeSelect.setMin($(this).text())}),e.find(".ptTimeSelectHr").bind("click",function(){jQuery.ptTimeSelect.setHr($(this).text())}),$(document).mousedown(jQuery.ptTimeSelect._doCheckMouseClick)}})}(),jQuery.ptTimeSelect.setHr=function(e){"am"==e.toLowerCase()||"pm"==e.toLowerCase()?jQuery("#ptTimeSelectUserSelAmPm").empty().append(e):jQuery("#ptTimeSelectUserSelHr").empty().append(e)},jQuery.ptTimeSelect.setMin=function(e){jQuery("#ptTimeSelectUserSelMin").empty().append(e)},jQuery.ptTimeSelect.setTime=function(){var e=jQuery("#ptTimeSelectUserSelHr").text()+":"+jQuery("#ptTimeSelectUserSelMin").text()+" "+jQuery("#ptTimeSelectUserSelAmPm").text();jQuery(".isPtTimeSelectActive").val(e),this.closeCntr()},
jQuery.ptTimeSelect.openCntr=function(e){jQuery.ptTimeSelect.closeCntr(),jQuery(".isPtTimeSelectActive").removeClass("isPtTimeSelectActive");var t=jQuery("#ptTimeSelectCntr"),o=jQuery(e).eq(0).addClass("isPtTimeSelectActive"),_=o.data("ptTimeSelectOptions"),i=o.offset();i["z-index"]=_.zIndex,i.top=i.top+o.outerHeight(),_.containerWidth&&(i.width=_.containerWidth),_.containerClass&&t.addClass(_.containerClass),t.css(i);var a=1,c="00",n="AM";if(o.val()){var r=/([0-9]{1,2}).*:.*([0-9]{2}).*(PM|AM)/i,l=r.exec(o.val());l&&(a=l[1]||1,c=l[2]||"00",n=l[3]||"AM")}t.find("#ptTimeSelectUserSelHr").empty().append(a),t.find("#ptTimeSelectUserSelMin").empty().append(c),t.find("#ptTimeSelectUserSelAmPm").empty().append(n),t.find(".ptTimeSelectTimeLabelsCntr .ptTimeSelectLeftPane").empty().append(_.hoursLabel),t.find(".ptTimeSelectTimeLabelsCntr .ptTimeSelectRightPane").empty().append(_.minutesLabel),t.find("#ptTimeSelectSetButton a").empty().append(_.setButtonLabel),_.onBeforeShow&&_.onBeforeShow(o,t),t.slideDown("fast")},jQuery.ptTimeSelect.closeCntr=function(e){var t=$("#ptTimeSelectCntr");if(1==t.is(":visible")){if(0==jQuery.support.tbody&&!(t[0].offsetWidth>0||t[0].offsetHeight>0))return;if(jQuery("#ptTimeSelectCntr").css("display","none").removeClass().css("width",""),e||(e=$(".isPtTimeSelectActive")),e){var o=e.removeClass("isPtTimeSelectActive").data("ptTimeSelectOptions");o&&o.onClose&&o.onClose(e)}}},jQuery.ptTimeSelect._doCheckMouseClick=function(e){$("#ptTimeSelectCntr:visible").length&&!jQuery(e.target).closest("#ptTimeSelectCntr").length&&jQuery(e.target).not("input.isPtTimeSelectActive").length&&jQuery.ptTimeSelect.closeCntr()},jQuery.fn.ptTimeSelect=function(e){return this.each(function(){if("input"==this.nodeName.toLowerCase()){var t=jQuery(this);if(t.hasClass("hasPtTimeSelect"))return this;var o={};if(o=$.extend(o,jQuery.ptTimeSelect.options,e),t.addClass("hasPtTimeSelect").data("ptTimeSelectOptions",o),o.popupImage||!o.onFocusDisplay){var _=jQuery('<span>&nbsp;</span><a href="javascript:" onclick="jQuery.ptTimeSelect.openCntr(jQuery(this).data(\'ptTimeSelectEle\'));">'+o.popupImage+"</a>").data("ptTimeSelectEle",t);t.after(_)}return o.onFocusDisplay&&t.focus(function(){jQuery.ptTimeSelect.openCntr(this)}),this}})}}(jQuery);