jQuery(document).ready(function(e) {
        function t() {
            if (jQuery("#checkbox-cyberchimps_portfolio_link_toggle_one").is(":checked")) {
                jQuery("tr.cyberchimps_portfolio_link_url_one td").append("<lable class='validation_error' id='url_validation_msg1'></lable>");
                var e = jQuery("#cyberchimps_portfolio_link_url_one").val();
                if (-1 == e.search(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/) || "" == e) return jQuery("#url_validation_msg1").html("Please enter a valid URL"), alert("Please enter a valid URL for Portfolio Lite Options"), !1;
                jQuery("#url_validation_msg1").html("")
            }
            return !0
        }

        function i() {
            if (jQuery("#checkbox-cyberchimps_portfolio_link_toggle_two").is(":checked")) {
                jQuery("tr.cyberchimps_portfolio_link_url_two td").append("<lable class='validation_error' id='url_validation_msg2'></lable>");
                var e = jQuery("#cyberchimps_portfolio_link_url_two").val();
                if (-1 == e.search(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/) || "" == e) return jQuery("#url_validation_msg2").html("Please enter a valid URL"), alert("Please enter a valid URL for Portfolio Lite Options"), !1;
                jQuery("#url_validation_msg2").html("")
            }
            return !0
        }

        function r() {
            if (jQuery("#checkbox-cyberchimps_portfolio_link_toggle_three").is(":checked")) {
                jQuery("tr.cyberchimps_portfolio_link_url_three td").append("<lable class='validation_error' id='url_validation_msg3'></lable>");
                var e = jQuery("#cyberchimps_portfolio_link_url_three").val();
                if (-1 == e.search(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/) || "" == e) return jQuery("#url_validation_msg3").html("Please enter a valid URL"), alert("Please enter a valid URL for Portfolio Lite Options"), !1;
                jQuery("#url_validation_msg3").html("")
            }
            return !0
        }

        function l() {
            if (jQuery("#checkbox-cyberchimps_portfolio_link_toggle_four").is(":checked")) {
                jQuery("tr.cyberchimps_portfolio_link_url_four td").append("<lable class='validation_error' id='url_validation_msg4'></lable>");
                var e = jQuery("#cyberchimps_portfolio_link_url_four").val();
                if (-1 == e.search(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/) || "" == e) return jQuery("#url_validation_msg4").html("Please enter a valid URL"), alert("Please enter a valid URL for Portfolio Lite Options"), !1;
                jQuery("#url_validation_msg4").html("")
            }
            return !0
        }
        e(".section-order").each(function() {
            ! function(t) {
                var i = e("#" + t);

                function r(r) {
                    var l = r.find("#values"),
                        o = "";
                    r.find(".right-list .list-items span").each(function() {
                        o += '<input type="hidden" name="' + t + '[]" value="' + e(this).data("key") + '" />'
                    }), l.html(o), i.find(".right-list .action").show(), i.find(".left-list .action").hide();
                    var n = r.find("input[class='section-order-tracker']");
                    o = [], r.find(".right-list .list-items span").each(function() {
                        o.push(e(this).data("key"))
                    }), n.val(o.join(",")).change(), e(".right-list .action").show(), e(".left-list .action").hide()
                }
                i.find(".left-list .list-items").delegate(".action", "click", function() {
                    var t = e(this).closest(".list-item");
                    e(this).closest(".section-order").children(".right-list").children(".list-items").append(t), r(e(this).closest(".section-order"))
                }), i.find(".right-list .list-items").delegate(".action", "click", function() {
                    var t = e(this).closest(".list-item");
                    e(this).val("Add"), e(this).closest(".section-order").children(".left-list").children(".list-items").append(t), e(this).hide(), r(e(this).closest(".section-order"))
                }), i.find(".right-list .list-items").sortable({
                    update: function() {
                        r(e(this).closest(".section-order"))
                    },
                    connectWith: "#" + t + " .left-list .list-items",
                    placeholder: "sortable-placeholder"
                }), i.find(".left-list .list-items").sortable({
                    connectWith: "#" + t + " .right-list .list-items",
                    placeholder: "sortable-placeholder"
                }), r(i)
            }(e(this).attr("id"))
        }), jQuery("#publish").click(function() {
            return t() && i() && r() && l()
        }), jQuery("#cyberchimps_portfolio_link_url_one").blur(function() {
            return t()
        }), jQuery("#cyberchimps_portfolio_link_url_two").blur(function() {
            return i()
        }), jQuery("#cyberchimps_portfolio_link_url_three").blur(function() {
            return r()
        }), jQuery("#cyberchimps_portfolio_link_url_four").blur(function() {
            return l()
        })
    }), jQuery(document).ready(function(e) {
        var t = Array;
        e("#cyberchimps_page_section_order .list-item span").each(function(i) {
            t[i] = e(this).data("key")
        }), e(".section-order-tracker").change(function() {
            var i = e(this).val().split(",");
            e.each(t, function(t, r) {
                -1 != e.inArray(r, i) ? (e("#" + r + "_options").removeClass("display_none"), e("#" + r + "_options").insertAfter("#cyberchimps_page_options"), e("#" + r + "_options").show(function() {
                    e(this).addClass("closed")
                })) : e("#" + r + "_options").addClass("display_none")
            })
        }).change(), e(".image-select").each(function() {
            e(this).find("img").click(function() {
                e(this).hasClass("selected") || (e(this).siblings("img").removeClass("selected"), e(this).addClass("selected"), e(this).siblings("input").val(e(this).data("key")))
            }), e(this).find("img.selected").length && e(this).find("input").val(e(this).find("img.selected").data("key"))
        }), e(".checkbox, .checkbox-toggle").after(function() {
            return e(this).is(":checked") ? "<a href='#' class='toggle checked' ref='" + e(this).attr("id") + "'></a>" : "<a href='#' class='toggle' ref='" + e(this).attr("id") + "'></a>"
        }), e(".toggle").click(function(t) {
            var i = e(this).attr("ref"),
                r = e("#" + i);
            r.is(":checked") ? r.removeAttr("checked").change() : r.attr("checked", "checked").change(), e(this).toggleClass("checked"), t.preventDefault()
        })
    }),
    function(e) {
        var t = function(t) {
            var i = t.data.id;
            e("#" + i).is(":checked");
            e("." + i + "-toggle-container").each(function() {
                e("#" + i).is(":checked") ? e("." + i + "-toggle-container").show() : e("." + i + "-toggle-container").hide()
            })
        };
        e(".at-field .checkbox-toggle").each(function() {
            e(this).on("change", {
                id: e(this).attr("id")
            }, t)
        }).change()
    }(jQuery),
    function(e) {
        e(".at-field .select-hide").each(function() {
            e(this).on("change", function() {
                var t, i, r = Array,
                    l = "";
                e(this).children("option").each(function(t) {
                    e(this).is(":selected") ? l += e(this).val() : r[t] = e(this).val()
                }), t = r, i = l, e.each(t, function(t, i) {
                    e("." + i + "-select-container").hide()
                }), e("." + i + "-select-container").show()
            }).change()
        })
    }(jQuery);
