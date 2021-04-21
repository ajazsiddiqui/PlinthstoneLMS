! function($) {
    "use strict";
    var Pages = function() {
        this.VERSION = "3.0.0", this.AUTHOR = "Revox", this.SUPPORT = "support@revox.io", this.pageScrollElement = "html, body", this.$body = $("body"), this.setUserOS(), this.setUserAgent()
    };
    Pages.prototype.setUserOS = function() {
        var OSName = ""; - 1 != navigator.appVersion.indexOf("Win") && (OSName = "windows"), -1 != navigator.appVersion.indexOf("Mac") && (OSName = "mac"), -1 != navigator.appVersion.indexOf("X11") && (OSName = "unix"), -1 != navigator.appVersion.indexOf("Linux") && (OSName = "linux"), this.$body.addClass(OSName)
    }, Pages.prototype.setUserAgent = function() {
        navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i) ? this.$body.addClass("mobile") : (this.$body.addClass("desktop"), navigator.userAgent.match(/MSIE 9.0/) && this.$body.addClass("ie9"))
    }, Pages.prototype.isVisibleXs = function() {
        return !$("#pg-visible-xs").length && this.$body.append('<div id="pg-visible-xs" class="visible-xs" />'), $("#pg-visible-xs").is(":visible")
    }, Pages.prototype.isVisibleSm = function() {
        return !$("#pg-visible-sm").length && this.$body.append('<div id="pg-visible-sm" class="visible-sm" />'), $("#pg-visible-sm").is(":visible")
    }, Pages.prototype.isVisibleMd = function() {
        return !$("#pg-visible-md").length && this.$body.append('<div id="pg-visible-md" class="visible-md" />'), $("#pg-visible-md").is(":visible")
    }, Pages.prototype.isVisibleLg = function() {
        return !$("#pg-visible-lg").length && this.$body.append('<div id="pg-visible-lg" class="visible-lg" />'), $("#pg-visible-lg").is(":visible")
    }, Pages.prototype.getUserAgent = function() {
        return $("body").hasClass("mobile") ? "mobile" : "desktop"
    }, Pages.prototype.setFullScreen = function(element) {
        var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;
        if (requestMethod) requestMethod.call(element);
        else if (void 0 !== window.ActiveXObject) {
            var wscript = new ActiveXObject("WScript.Shell");
            null !== wscript && wscript.SendKeys("{F11}")
        }
    }, Pages.prototype.getColor = function(color, opacity) {
        opacity = parseFloat(opacity) || 1;
        var elem = $(".pg-colors").length ? $(".pg-colors") : $('<div class="pg-colors"></div>').appendTo("body"),
            rgb = (color = (elem.find('[data-color="' + color + '"]').length ? elem.find('[data-color="' + color + '"]') : $('<div class="bg-' + color + '" data-color="' + color + '"></div>').appendTo(elem)).css("background-color")).match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        return "rgba(" + rgb[1] + ", " + rgb[2] + ", " + rgb[3] + ", " + opacity + ")"
    }, Pages.prototype.initSidebar = function(context) {
        $('[data-pages="sidebar"]', context).each(function() {
            var $sidebar = $(this);
            $sidebar.sidebar($sidebar.data())
        })
    }, Pages.prototype.initDropDown = function(context) {
        $(".dropdown-default", context).each(function() {
            var btn = $(this).find(".dropdown-menu").siblings(".dropdown-toggle"),
                menuWidth = $(this).find(".dropdown-menu").actual("outerWidth");
            btn.actual("outerWidth") < menuWidth ? (btn.width(menuWidth - 0), $(this).find(".dropdown-menu").width(btn.actual("outerWidth"))) : $(this).find(".dropdown-menu").width(btn.actual("outerWidth"))
        })
    }, Pages.prototype.initFormGroupDefault = function(context) {
        $(".form-group.form-group-default", context).click(function() {
            $(this).find("input").focus()
        }), this.initFormGroupDefaultRun || ($("body").on("focus", ".form-group.form-group-default :input", function() {
            $(".form-group.form-group-default").removeClass("focused"), $(this).parents(".form-group").addClass("focused")
        }), $("body").on("blur", ".form-group.form-group-default :input", function() {
            $(this).parents(".form-group").removeClass("focused"), $(this).val() ? $(this).closest(".form-group").find("label").addClass("fade") : $(this).closest(".form-group").find("label").removeClass("fade")
        }), this.initFormGroupDefaultRun = !0), $(".form-group.form-group-default .checkbox, .form-group.form-group-default .radio", context).hover(function() {
            $(this).parents(".form-group").addClass("focused")
        }, function() {
            $(this).parents(".form-group").removeClass("focused")
        })
    }, Pages.prototype.initSlidingTabs = function(context) {
        $('a[data-toggle="tab"]', context).on("show.bs.tab", function(e) {
            var hrefCurrent = (e = $(e.target).parent().find("a[data-toggle=tab]")).data("target");
            void 0 === hrefCurrent && (hrefCurrent = e.attr("href")), $(hrefCurrent).is(".slide-left, .slide-right") && ($(hrefCurrent).addClass("sliding"), setTimeout(function() {
                $(hrefCurrent).removeClass("sliding")
            }, 100))
        })
    }, Pages.prototype.reponsiveTabs = function() {
        $('[data-init-reponsive-tabs="dropdownfx"]').each(function() {
            var drop = $(this);
            drop.addClass("hidden-sm-down");
            for (var content = '<select class="cs-select cs-skin-slide full-width" data-init-plugin="cs-select">', i = 1; i <= drop.children("li").length; i++) {
                var li = drop.children("li:nth-child(" + i + ")"),
                    selected = "";
                li.children("a").hasClass("active") && (selected = "selected");
                var tabRef = li.children("a").attr("href");
                "#" == tabRef && (tabRef = li.children("a").attr("data-target")), content += '<option value="' + tabRef + '" ' + selected + ">", content += li.children("a").text(), content += "</option>"
            }
            content += "</select>", drop.after(content);
            var select = drop.next()[0];
            $(select).on("change", function(e) {
                $("option:selected", this);
                var valueSelected = this.value,
                    tabLink = drop.find('a[data-target="' + valueSelected + '"]');
                0 == tabLink.length && (tabLink = drop.find('a[data-target="' + valueSelected + '"]')), tabLink.tab("show")
            }), $(select).wrap('<div class="nav-tab-dropdown cs-wrapper full-width hidden-md-up"></div>'), new SelectFx(select)
        })
    }, Pages.prototype.initNotificationCenter = function() {
        $("body").on("click", ".notification-list .dropdown-menu", function(event) {
            event.stopPropagation()
        }), $("body").on("click", ".toggle-more-details", function(event) {
            var p = $(this).closest(".heading");
            p.closest(".heading").children(".more-details").stop().slideToggle("fast", function() {
                p.toggleClass("open")
            })
        })
    }, Pages.prototype.initProgressBars = function() {
        $(window).on("load", function() {
            $(".progress-bar-indeterminate, .progress-circle-indeterminate, .mapplic-pin").hide().show(0)
        })
    }, Pages.prototype.initInputFile = function() {
        $(document).on("change", ".btn-file :file", function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, "/").replace(/.*\//, "");
            input.trigger("fileselect", [numFiles, label])
        }), $(".btn-file :file").on("fileselect", function(event, numFiles, label) {
            var input = $(this).parents(".input-group").find(":text"),
                log = numFiles > 1 ? numFiles + " files selected" : label;
            input.length ? input.val(log) : $(this).parent().html(log)
        })
    }, Pages.prototype.initHorizontalMenu = function() {
        function autoHideLi() {
            var hMenu = $("[data-pages-init='horizontal-menu']"),
                extraLiHide = parseInt(hMenu.data("hideExtraLi")) || 0;
            if (0 != hMenu.length) {
                var hMenuRect = hMenu[0].getBoundingClientRect(),
                    liTotalWidth = 0,
                    liCount = 0;
                if (hMenu.children("ul").children("li.more").remove(), hMenu.children("ul").children("li").each(function(index) {
                        $(this).removeAttr("style"), liTotalWidth += $(this).outerWidth(!0), liCount++
                    }), !($(window).width() < 992)) {
                    var possibleLi = parseInt(hMenuRect.width / (liTotalWidth / liCount)) - 1;
                    if (possibleLi -= extraLiHide, liCount > possibleLi)
                        for (var wrapper = createWrapperLI(hMenu), i = possibleLi; i < liCount; i++) {
                            var currentLi = hMenu.children("ul").children("li").eq(i),
                                clone = currentLi.clone();
                            clone.children("ul").addClass("sub-menu"), wrapper.children("ul").append(clone), currentLi.hide()
                        }
                }
            }
        }

        function createWrapperLI(hMenu) {
            hMenu.children("ul").append("<li class='more'><a href='javascript:;'><span class='title'><i class='pg pg-more'></i></span></a><ul></ul></li>");
            return hMenu.children("ul").children("li.more")
        }

        function _hideMenu($el) {
            var ul = $($el.children("ul")[0]),
                ghost = $("<div class='ghost-nav-dropdown'></div>");
            if (0 != ul.length) {
                var rect = ul[0].getBoundingClientRect();
                ghost.css({
                    width: rect.width + "px",
                    height: rect.height + "px",
                    "z-index": "auto"
                }), $el.append(ghost);
                var timingSpeed = ul.children("li").css("transition-duration");
                timingSpeed = parseInt(1e3 * parseFloat(timingSpeed)), $el.addClass("closing"), window.clearTimeout(animationTimer), animationTimer = window.setTimeout(function() {
                    ghost.height(0), $el.removeClass("open opening closing")
                }, timingSpeed - 80)
            }
        }

        function _showMenu($el) {
            var ul = $($el.children("ul")[0]),
                ghost = $("<div class='ghost-nav-dropdown'></div>");
            if ($el.children(".ghost-nav-dropdown").remove(), $el.addClass("open").siblings().removeClass("open opening"), 0 != ul.length) {
                var rect = ul[0].getBoundingClientRect();
                ghost.css({
                    width: rect.width + "px",
                    height: "0px"
                }), $el.append(ghost), ghost.height(rect.height);
                var timingSpeed = ghost.css("transition-duration");
                timingSpeed = parseInt(1e3 * parseFloat(timingSpeed)), window.clearTimeout(animationTimer), animationTimer = window.setTimeout(function() {
                    $el.addClass("opening"), ghost.remove()
                }, timingSpeed)
            }
        }
        var animationTimer;
        $("[data-pages-init='horizontal-menu']");
        autoHideLi(), $(document).on("click", ".menu-bar > ul > li", function() {
            if (0 != $(this).children("ul").length)
                if ($(window).width() < 992) {
                    var menubar = $(".menu-bar"),
                        el = $(this),
                        sub = (menubar.find("li"), $(this).children("ul"));
                    el.hasClass("open active") ? (el.find(".arrow").removeClass("open active"), sub.slideUp(200, function() {
                        el.removeClass("open active")
                    })) : (menubar.find("li.open").find("ul").slideUp(200), menubar.find("li.open").find("a").find(".arrow").removeClass("open active"), menubar.find("li.open").removeClass("open active"), el.find(".arrow").addClass("open active"), sub.slideDown(200, function() {
                        el.addClass("open active")
                    }))
                } else $(this).hasClass("opening") ? _hideMenu($(this)) : _showMenu($(this))
        });
        var resizeTimer;
        $(window).on("resize", function(e) {
            clearTimeout(resizeTimer), resizeTimer = setTimeout(function() {
                autoHideLi()
            }, 250)
        }), $(".content").on("click", function() {
            $(".horizontal-menu .bar-inner > ul > li").removeClass("open"), $(".menu-bar > ul > li").removeClass("open opening").children("ul").removeAttr("style"), $("body").find(".ghost-nav-dropdown").remove()
        }), $('[data-toggle="horizontal-menu"]').on("click touchstart", function(e) {
            e.preventDefault(), $("body").toggleClass("horizontal-menu-open"), $(".horizontal-menu-backdrop").length ? $(".horizontal-menu-backdrop").fadeToggle("fast", function() {
                $(this).remove()
            }) : ($(".header").append('<div class="horizontal-menu-backdrop"/>'), $(".horizontal-menu-backdrop").fadeToggle("fast")), $(".menu-bar").toggleClass("open")
        })
    }, Pages.prototype.initTooltipPlugin = function(context) {
        $.fn.tooltip && $('[data-toggle="tooltip"]', context).tooltip()
    }, Pages.prototype.initSelect2Plugin = function(context) {
        $.fn.select2 && $('[data-init-plugin="select2"]', context).each(function() {
            $(this).select2({
                minimumResultsForSearch: "true" == $(this).attr("data-disable-search") ? -1 : 1
            }).on("select2:open", function() {
                $.fn.scrollbar && $(".select2-results__options").scrollbar({
                    ignoreMobile: !1
                })
            })
        })
    }, Pages.prototype.initScrollBarPlugin = function(context) {
        $.fn.scrollbar && $(".scrollable", context).scrollbar({
            ignoreOverlay: !1
        })
    }, Pages.prototype.initListView = function(context) {
        $.fn.ioslist && $('[data-init-list-view="ioslist"]', context).ioslist(), $.fn.scrollbar && $(".list-view-wrapper", context).scrollbar({
            ignoreOverlay: !1
        })
    }, Pages.prototype.initSwitcheryPlugin = function(context) {
        window.Switchery && $('[data-init-plugin="switchery"]', context).each(function() {
            var el = $(this);
            new Switchery(el.get(0), {
                color:'#0075b4',
                size: null != el.data("size") ? el.data("size") : "default"
            })
        })
    }, Pages.prototype.initSelectFxPlugin = function(context) {
        window.SelectFx && $('select[data-init-plugin="cs-select"]', context).each(function() {
            var el = $(this).get(0);
            $(el).wrap('<div class="cs-wrapper"></div>'), new SelectFx(el)
        })
    }, Pages.prototype.initUnveilPlugin = function(context) {
        $.fn.unveil && $("img", context).unveil()
    }, Pages.prototype.initValidatorPlugin = function() {
        $.validator && $.validator.setDefaults({
            ignore: "",
            showErrors: function(errorMap, errorList) {
                var $this = this;
                return $.each(this.successList, function(index, value) {
                    if ($(this).closest(".form-group-attached").length) return $(value).popover("hide")
                }), $.each(errorList, function(index, value) {
                    var parent = $(value.element).closest(".form-group-attached");
                    if (!parent.length) return $this.defaultShowErrors();
                    $(value.element).popover({
                        trigger: "manual",
                        placement: "top",
                        html: !0,
                        container: parent.closest("form"),
                        content: value.message
                    }), (parent = $(value.element).closest(".form-group")).addClass("has-error"), $(value.element).popover("show")
                })
            },
            onfocusout: function(element) {
                var parent = $(element).closest(".form-group");
                $(element).valid() && (parent.removeClass("has-error"), parent.next(".error").remove())
            },
            onkeyup: function(element) {
                var parent = $(element).closest(".form-group");
                $(element).valid() ? ($(element).removeClass("error"), parent.removeClass("has-error"), parent.next("label.error").remove(), parent.find("label.error").remove()) : parent.addClass("has-error")
            },
            errorPlacement: function(error, element) {
                var parent = $(element).closest(".form-group");
                parent.hasClass("form-group-default") ? (parent.addClass("has-error"), error.insertAfter(parent)) : error.insertAfter(element)
            }
        })
    }, Pages.prototype.setBackgroundImage = function() {
        $("[data-pages-bg-image]").each(function() {
            var _elem = $(this),
                defaults = {
                    pagesBgImage: "",
                    lazyLoad: "true",
                    progressType: "",
                    progressColor: "",
                    bgOverlay: "",
                    bgOverlayClass: "",
                    overlayOpacity: 0
                },
                data = _elem.data();
            $.extend(defaults, data);
            var url = defaults.pagesBgImage,
                color = defaults.bgOverlay,
                opacity = defaults.overlayOpacity,
                overlay = $('<div class="bg-overlay"></div>');
            overlay.addClass(defaults.bgOverlayClass), overlay.css({
                "background-color": color,
                opacity: 1
            }), _elem.append(overlay);
            var img = new Image;
            img.src = url, img.onload = function() {
                _elem.css({
                    "background-image": "url(" + url + ")"
                }), _elem.children(".bg-overlay").css({
                    opacity: opacity
                })
            }
        })
    }, Pages.prototype.secondarySidebar = function() {
        $('[data-init="secondary-sidebar"]').each(function() {
            $(this).on("click", ".main-menu li a", function(e) {
                if (!1 !== $(this).parent().children(".sub-menu")) {
                    var el = $(this),
                        parent = $(this).parent().parent(),
                        li = $(this).parent(),
                        sub = $(this).parent().children(".sub-menu");
                    li.hasClass("open active") ? (el.children(".arrow").removeClass("open active"), sub.slideUp(200, function() {
                        li.removeClass("open active")
                    })) : (parent.children("li.open").children(".sub-menu").slideUp(200), parent.children("li.open").children("a").children(".arrow").removeClass("open active"), parent.children("li.open").removeClass("open active"), el.children(".arrow").addClass("open active"), sub.slideDown(200, function() {
                        li.addClass("open active")
                    }))
                }
            })
        }), $('[data-init="secondary-sidebar-toggle"]').each(function() {
            $(this).on("click", function(e) {
                var toggleRect = $(this).get(0).getBoundingClientRect(),
                    menu = $('[data-init="secondary-sidebar"]');
                if (menu.hasClass("open")) menu.removeClass("open"), menu.removeAttr("style");
                else {
                    menu.addClass("open");
                    var menuRect = menu.get(0).getBoundingClientRect();
                    menu.css({
                        top: toggleRect.bottom,
                        "max-height": $(window).height() - toggleRect.bottom,
                        left: $(window).width() / 2 - menuRect.width / 2,
                        visibility: "visible"
                    })
                }
            })
        })
    }, Pages.prototype.init = function() {
        this.initSidebar(), this.setBackgroundImage(), this.initDropDown(), this.initFormGroupDefault(), this.initSlidingTabs(), this.initNotificationCenter(), this.initProgressBars(), this.initHorizontalMenu(), this.initTooltipPlugin(), this.initSelect2Plugin(), this.initScrollBarPlugin(), this.initSwitcheryPlugin(), this.initSelectFxPlugin(), this.initUnveilPlugin(), this.initValidatorPlugin(), this.initListView(), this.initInputFile(), this.reponsiveTabs(), this.secondarySidebar()
    }, $.Pages = new Pages, $.Pages.Constructor = Pages
}(window.jQuery),
function(window) {
    "use strict";

    function hasParent(e, p) {
        if (!e) return !1;
        for (var el = e.target || e.srcElement || e || !1; el && el != p;) el = el.parentNode || !1;
        return !1 !== el
    }

    function extend(a, b) {
        for (var key in b) b.hasOwnProperty(key) && (a[key] = b[key]);
        return a
    }

    function SelectFx(el, options) {
        this.el = el, this.options = extend({}, this.options), extend(this.options, options), this._init()
    }

    function closest(elem, selector) {
        for (var matchesSelector = elem.matches || elem.webkitMatchesSelector || elem.mozMatchesSelector || elem.msMatchesSelector; elem;) {
            if (matchesSelector.bind(elem)(selector)) return elem;
            elem = elem.parentElement
        }
        return !1
    }

    function offset(el) {
        return {
            left: el.getBoundingClientRect().left + window.pageXOffset - el.ownerDocument.documentElement.clientLeft,
            top: el.getBoundingClientRect().top + window.pageYOffset - el.ownerDocument.documentElement.clientTop
        }
    }

    function insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
    }
    SelectFx.prototype.options = {
        newTab: !0,
        stickyPlaceholder: !0,
        container: "body",
        onChange: function(el) {
            var event = document.createEvent("HTMLEvents");
            event.initEvent("change", !0, !1), el.dispatchEvent(event)
        }
    }, SelectFx.prototype._init = function() {
        var selectedOpt = document.querySelector("option[selected]");
        this.hasDefaultPlaceholder = selectedOpt && selectedOpt.disabled, this.selectedOpt = selectedOpt || this.el.querySelector("option"), this._createSelectEl(), this.selOpts = [].slice.call(this.selEl.querySelectorAll("li[data-option]")), this.selOptsCount = this.selOpts.length, this.current = this.selOpts.indexOf(this.selEl.querySelector("li.cs-selected")) || -1, this.selPlaceholder = this.selEl.querySelector("span.cs-placeholder"), this._initEvents(), this.el.onchange = function() {
            var index = this.selectedIndex;
            this.children[index].innerHTML.trim()
        }
    }, SelectFx.prototype._createSelectEl = function() {
        var options = "",
            createOptionHTML = function(el) {
                var optclass = "",
                    classes = "",
                    link = "";
                return !el.selectedOpt || this.foundSelected || this.hasDefaultPlaceholder || (classes += "cs-selected ", this.foundSelected = !0), el.getAttribute("data-class") && (classes += el.getAttribute("data-class")), el.getAttribute("data-link") && (link = "data-link=" + el.getAttribute("data-link")), "" !== classes && (optclass = 'class="' + classes + '" '), "<li " + optclass + link + ' data-option data-value="' + el.value + '"><span>' + el.textContent + "</span></li>"
            };
        [].slice.call(this.el.children).forEach(function(el) {
            if (!el.disabled) {
                var tag = el.tagName.toLowerCase();
                "option" === tag ? options += createOptionHTML(el) : "optgroup" === tag && (options += '<li class="cs-optgroup"><span>' + el.label + "</span><ul>", [].slice.call(el.children).forEach(function(opt) {
                    options += createOptionHTML(opt)
                }), options += "</ul></li>")
            }
        });
        var opts_el = '<div class="cs-options"><ul>' + options + "</ul></div>";
        this.selEl = document.createElement("div"), this.selEl.className = this.el.className, this.selEl.tabIndex = this.el.tabIndex, this.selEl.innerHTML = '<span class="cs-placeholder">' + this.selectedOpt.textContent + "</span>" + opts_el, this.el.parentNode.appendChild(this.selEl), this.selEl.appendChild(this.el);
        var backdrop = document.createElement("div");
        backdrop.className = "cs-backdrop", this.selEl.appendChild(backdrop)
    }, SelectFx.prototype._initEvents = function() {
        var self = this;
        this.selPlaceholder.addEventListener("click", function() {
            self._toggleSelect()
        }), this.selOpts.forEach(function(opt, idx) {
            opt.addEventListener("click", function() {
                self.current = idx, self._changeOption(), self._toggleSelect()
            })
        }), document.addEventListener("click", function(ev) {
            var target = ev.target;
            self._isOpen() && target !== self.selEl && !hasParent(target, self.selEl) && self._toggleSelect()
        }), this.selEl.addEventListener("keydown", function(ev) {
            switch (ev.keyCode || ev.which) {
                case 38:
                    ev.preventDefault(), self._navigateOpts("prev");
                    break;
                case 40:
                    ev.preventDefault(), self._navigateOpts("next");
                    break;
                case 32:
                    ev.preventDefault(), self._isOpen() && void 0 !== self.preSelCurrent && -1 !== self.preSelCurrent && self._changeOption(), self._toggleSelect();
                    break;
                case 13:
                    ev.preventDefault(), self._isOpen() && void 0 !== self.preSelCurrent && -1 !== self.preSelCurrent && (self._changeOption(), self._toggleSelect());
                    break;
                case 27:
                    ev.preventDefault(), self._isOpen() && self._toggleSelect()
            }
        })
    }, SelectFx.prototype._navigateOpts = function(dir) {
        this._isOpen() || this._toggleSelect();
        var tmpcurrent = void 0 !== this.preSelCurrent && -1 !== this.preSelCurrent ? this.preSelCurrent : this.current;
        ("prev" === dir && tmpcurrent > 0 || "next" === dir && tmpcurrent < this.selOptsCount - 1) && (this.preSelCurrent = "next" === dir ? tmpcurrent + 1 : tmpcurrent - 1, this._removeFocus(), classie.add(this.selOpts[this.preSelCurrent], "cs-focus"))
    }, SelectFx.prototype._toggleSelect = function() {
        var backdrop = this.selEl.querySelector(".cs-backdrop"),
            container = document.querySelector(this.options.container),
            mask = container.querySelector(".dropdown-mask"),
            csOptions = this.selEl.querySelector(".cs-options"),
            csPlaceholder = this.selEl.querySelector(".cs-placeholder"),
            csPlaceholderWidth = csPlaceholder.offsetWidth,
            csPlaceholderHeight = csPlaceholder.offsetHeight,
            csOptionsWidth = csOptions.scrollWidth;
        if (this._isOpen()) {
            -1 !== this.current && (this.selPlaceholder.textContent = this.selOpts[this.current].textContent);
            var parent = (dummy = this.selEl.data).parentNode;
            insertAfter(this.selEl, dummy), this.selEl.removeAttribute("style"), parent.removeChild(dummy);
            this.selEl.clientHeight;
            backdrop.style.transform = backdrop.style.webkitTransform = backdrop.style.MozTransform = backdrop.style.msTransform = backdrop.style.OTransform = "scale3d(1,1,1)", classie.remove(this.selEl, "cs-active"), mask.style.display = "none", csOptions.style.overflowY = "hidden", csOptions.style.width = "auto";
            var parentFormGroup = closest(this.selEl, ".form-group");
            parentFormGroup && classie.removeClass(parentFormGroup, "focused")
        } else {
            this.hasDefaultPlaceholder && this.options.stickyPlaceholder && (this.selPlaceholder.textContent = this.selectedOpt.textContent);
            var dummy;
            this.selEl.parentNode.querySelector(".dropdown-placeholder") ? dummy = this.selEl.parentNode.querySelector(".dropdown-placeholder") : (dummy = document.createElement("div"), classie.add(dummy, "dropdown-placeholder"), insertAfter(dummy, this.selEl)), dummy.style.height = csPlaceholderHeight + "px", dummy.style.width = this.selEl.offsetWidth + "px", this.selEl.data = dummy, this.selEl.style.position = "absolute";
            var offsetselEl = offset(this.selEl);
            this.selEl.style.left = offsetselEl.left + "px", this.selEl.style.top = offsetselEl.top + "px", container.appendChild(this.selEl);
            var contentHeight = csOptions.offsetHeight,
                originalHeight = csPlaceholder.offsetHeight,
                scaleV = (csOptions.offsetWidth, csPlaceholder.offsetWidth, contentHeight / originalHeight);
            backdrop.style.transform = backdrop.style.webkitTransform = backdrop.style.MozTransform = backdrop.style.msTransform = backdrop.style.OTransform = "scale3d(1, " + scaleV + ", 1)", mask || (mask = document.createElement("div"), classie.add(mask, "dropdown-mask"), container.appendChild(mask)), mask.style.display = "block", classie.add(this.selEl, "cs-active");
            var resizedWidth = csPlaceholderWidth < csOptionsWidth ? csOptionsWidth : csPlaceholderWidth;
            this.selEl.style.width = resizedWidth + "px", this.selEl.style.height = originalHeight + "px", csOptions.style.width = "100%", setTimeout(function() {
                csOptions.style.overflowY = "auto"
            }, 300)
        }
    }, SelectFx.prototype._changeOption = function() {
        void 0 !== this.preSelCurrent && -1 !== this.preSelCurrent && (this.current = this.preSelCurrent, this.preSelCurrent = -1);
        var opt = this.selOpts[this.current];
        this.selPlaceholder.textContent = opt.textContent, this.el.value = opt.getAttribute("data-value");
        var oldOpt = this.selEl.querySelector("li.cs-selected");
        oldOpt && classie.remove(oldOpt, "cs-selected"), classie.add(opt, "cs-selected"), opt.getAttribute("data-link") && (this.options.newTab ? window.open(opt.getAttribute("data-link"), "_blank") : window.location = opt.getAttribute("data-link")), this.options.onChange(this.el)
    }, SelectFx.prototype._isOpen = function(opt) {
        return classie.has(this.selEl, "cs-active")
    }, SelectFx.prototype._removeFocus = function(opt) {
        var focusEl = this.selEl.querySelector("li.cs-focus");
        focusEl && classie.remove(focusEl, "cs-focus")
    }, window.SelectFx = SelectFx
}(window),
function($) {
    "use strict";
    $("[data-chat-input]").on("keypress", function(e) {
        if (13 == e.which) {
            var el = $(this).attr("data-chat-conversation");
            $(el).append('<div class="message clearfix"><div class="chat-bubble from-me">' + $(this).val() + "</div></div>"), $(this).val("")
        }
    })
}(window.jQuery),
function($) {
    "use strict";

    function perc2deg(p) {
        return parseInt(p / 100 * 360)
    }
    var Progress = function(element, options) {
        this.$element = $(element), this.options = $.extend(!0, {}, $.fn.circularProgress.defaults, options), this.$container = $('<div class="progress-circle"></div>'), this.$element.attr("data-color") && this.$container.addClass("progress-circle-" + this.$element.attr("data-color")), this.$element.attr("data-thick") && this.$container.addClass("progress-circle-thick"), this.$pie = $('<div class="pie"></div>'), this.$pie.$left = $('<div class="left-side half-circle"></div>'), this.$pie.$right = $('<div class="right-side half-circle"></div>'), this.$pie.append(this.$pie.$left).append(this.$pie.$right), this.$container.append(this.$pie).append('<div class="shadow"></div>'), this.$element.after(this.$container), this.val = this.$element.val();
        var deg = perc2deg(this.val);
        this.val <= 50 ? this.$pie.$right.css("transform", "rotate(" + deg + "deg)") : (this.$pie.css("clip", "rect(auto, auto, auto, auto)"), this.$pie.$right.css("transform", "rotate(180deg)"), this.$pie.$left.css("transform", "rotate(" + deg + "deg)"))
    };
    Progress.VERSION = "1.0.0", Progress.prototype.value = function(val) {
        if (void 0 !== val) {
            var deg = perc2deg(val);
            this.$pie.removeAttr("style"), this.$pie.$right.removeAttr("style"), this.$pie.$left.removeAttr("style"), val <= 50 ? this.$pie.$right.css("transform", "rotate(" + deg + "deg)") : (this.$pie.css("clip", "rect(auto, auto, auto, auto)"), this.$pie.$right.css("transform", "rotate(180deg)"), this.$pie.$left.css("transform", "rotate(" + deg + "deg)"))
        }
    };
    var old = $.fn.circularProgress;
    $.fn.circularProgress = function(option) {
        return this.filter(":input").each(function() {
            var $this = $(this),
                data = $this.data("pg.circularProgress"),
                options = "object" == typeof option && option;
            data || $this.data("pg.circularProgress", data = new Progress(this, options)), "string" == typeof option ? data[option]() : options.hasOwnProperty("value") && data.value(options.value)
        })
    }, $.fn.circularProgress.Constructor = Progress, $.fn.circularProgress.defaults = {
        value: 0
    }, $.fn.circularProgress.noConflict = function() {
        return $.fn.circularProgress = old, this
    }, $(window).on("load", function() {
        $('[data-pages-progress="circle"]').each(function() {
            var $progress = $(this);
            $progress.circularProgress($progress.data())
        })
    })
}(window.jQuery),
function($) {
    "use strict";
    var Notification = function(container, options) {
        function SimpleNotification() {
            if (self.notification.addClass("pgn-simple"), self.alert.append(self.options.message), self.options.showClose) {
                var close = $('<button type="button" class="close" data-dismiss="alert"></button>').append('<span aria-hidden="true">&times;</span>').append('<span class="sr-only">Close</span>');
                self.alert.prepend(close)
            }
        }

        function alignWrapperToContainer() {
            var containerPosition = self.container.position(),
                containerHeight = self.container.height(),
                containerWidth = self.container.width(),
                containerTop = containerPosition.top,
                containerBottom = self.container.parent().height() - (containerTop + containerHeight),
                containerLeft = containerPosition.left,
                containerRight = self.container.parent().width() - (containerLeft + containerWidth);
            /top/.test(self.options.position) && self.wrapper.css("top", containerTop), /bottom/.test(self.options.position) && self.wrapper.css("bottom", containerBottom), /left/.test(self.options.position) && self.wrapper.css("left", containerLeft), /right/.test(self.options.position) && self.wrapper.css("right", containerRight)
        }
        var self = this;
        return self.container = $(container), self.notification = $('<div class="pgn push-on-sidebar-open"></div>'), self.options = $.extend(!0, {}, $.fn.pgNotification.defaults, options), self.container.find(".pgn-wrapper[data-position=" + this.options.position + "]").length ? self.wrapper = $(".pgn-wrapper[data-position=" + this.options.position + "]") : (self.wrapper = $('<div class="pgn-wrapper" data-position="' + this.options.position + '"></div>'), self.container.append(self.wrapper)), self.alert = $('<div class="alert"></div>'), self.alert.addClass("alert-" + self.options.type), "bar" == self.options.style ? new function() {
            self.notification.addClass("pgn-bar"), self.alert.addClass("alert-" + self.options.type);
            var container = $('<div class="container"/>');
            if (container.append("<span>" + self.options.message + "</span>"), self.options.showClose) {
                var close = $('<button type="button" class="close" data-dismiss="alert"></button>').append('<span aria-hidden="true">&times;</span>').append('<span class="sr-only">Close</span>');
                container.append(close)
            }
            self.alert.append(container)
        } : "flip" == self.options.style ? new function() {
            if (self.notification.addClass("pgn-flip"), self.alert.append("<span>" + self.options.message + "</span>"), self.options.showClose) {
                var close = $('<button type="button" class="close" data-dismiss="alert"></button>').append('<span aria-hidden="true">&times;</span>').append('<span class="sr-only">Close</span>');
                self.alert.prepend(close)
            }
        } : "circle" == self.options.style ? new function() {
            self.notification.addClass("pgn-circle");
            var table = "<div>";
            self.options.thumbnail && (table += '<div class="pgn-thumbnail"><div>' + self.options.thumbnail + "</div></div>"), table += '<div class="pgn-message"><div>', self.options.title && (table += '<p class="bold">' + self.options.title + "</p>"), table += "<p>" + self.options.message + "</p></div></div>", table += "</div>", self.options.showClose && (table += '<button type="button" class="close" data-dismiss="alert">', table += '<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>', table += "</button>"), self.alert.append(table), self.alert.after('<div class="clearfix"></div>')
        } : (self.options.style, new SimpleNotification), self.notification.append(self.alert), $("body").hasClass("horizontal-menu") && (alignWrapperToContainer(), $(window).on("resize", alignWrapperToContainer)), self.alert.on("closed.bs.alert", function() {
            self.notification.remove(), self.options.onClosed()
        }), this
    };
    Notification.VERSION = "1.0.0", Notification.prototype.show = function() {
        if (this.wrapper.prepend(this.notification), this.options.onShown(), 0 != this.options.timeout) {
            var _this = this;
            setTimeout(function() {
                this.notification.fadeOut("slow", function() {
                    $(this).remove(), _this.options.onClosed()
                })
            }.bind(this), this.options.timeout)
        }
    }, $.fn.pgNotification = function(options) {
        return new Notification(this, options)
    }, $.fn.pgNotification.defaults = {
        style: "simple",
        message: null,
        position: "top-right",
        type: "info",
        showClose: !0,
        timeout: 4e3,
        onShown: function() {},
        onClosed: function() {}
    }
}(window.jQuery),
function($) {
    "use strict";
    var Card = function(element, options) {
        this.$element = $(element), this.options = $.extend(!0, {}, $.fn.card.defaults, options), this.$loader = null, this.$body = this.$element.find(".card-block")
    };
    Card.VERSION = "1.0.0", Card.prototype.collapse = function() {
        var icon = this.$element.find(this.options.collapseButton + " > i");
        this.$element.find(".card-header");
        if (this.$body.stop().slideToggle("fast"), this.$element.hasClass("card-collapsed")) return this.$element.removeClass("card-collapsed"), icon.removeClass().addClass("pg-arrow_maximize"), void($.isFunction(this.options.onExpand) && this.options.onExpand(this));
        this.$element.addClass("card-collapsed"), icon.removeClass().addClass("pg-arrow_minimize"), $.isFunction(this.options.onCollapse) && this.options.onCollapse(this)
    }, Card.prototype.close = function() {
        this.$element.remove(), $.isFunction(this.options.onClose) && this.options.onClose(this)
    }, Card.prototype.maximize = function() {
        var icon = this.$element.find(this.options.maximizeButton + " > i");
        if (this.$element.hasClass("card-maximized")) this.$element.removeClass("card-maximized"), this.$element.attr("style", ""), icon.removeClass("pg-fullscreen_restore").addClass("pg-fullscreen"), $.isFunction(this.options.onRestore) && this.options.onRestore(this);
        else {
            var sidebar = $('[data-pages="sidebar"]'),
                header = $(".header"),
                sidebarWidth = 0;
            sidebar && (sidebarWidth = sidebar.position().left + sidebar.width());
            var headerHeight = header.height();
            this.$element.addClass("card-maximized"), this.$element.css("left", sidebarWidth), this.$element.css("top", headerHeight), icon.removeClass("pg-fullscreen").addClass("pg-fullscreen_restore"), $.isFunction(this.options.onMaximize) && this.options.onMaximize(this)
        }
    }, Card.prototype.refresh = function(refresh) {
        var toggle = this.$element.find(this.options.refreshButton);
        if (refresh) {
            if (this.$loader && this.$loader.is(":visible")) return;
            if (!$.isFunction(this.options.onRefresh)) return;
            this.$loader = $('<div class="card-progress"></div>'), this.$loader.css({
                "background-color": "rgba(" + this.options.overlayColor + "," + this.options.overlayOpacity + ")"
            });
            var elem = "";
            if ("circle" == this.options.progress) elem += '<div class="progress-circle-indeterminate progress-circle-' + this.options.progressColor + '"></div>';
            else if ("bar" == this.options.progress) elem += '<div class="progress progress-small">', elem += '    <div class="progress-bar-indeterminate progress-bar-' + this.options.progressColor + '"></div>', elem += "</div>";
            else if ("circle-lg" == this.options.progress) {
                toggle.addClass("refreshing");
                var iconNew, iconOld = toggle.find("> i").first();
                toggle.find('[class$="-animated"]').length ? iconNew = toggle.find('[class$="-animated"]') : ((iconNew = $("<i/>")).css({
                    position: "absolute",
                    top: iconOld.position().top,
                    left: iconOld.position().left
                }), iconNew.addClass("card-icon-refresh-lg-" + this.options.progressColor + "-animated"), toggle.append(iconNew)), iconOld.addClass("fade"), iconNew.addClass("active")
            } else elem += '<div class="progress progress-small">', elem += '    <div class="progress-bar-indeterminate progress-bar-' + this.options.progressColor + '"></div>', elem += "</div>";
            this.$loader.append(elem), this.$element.append(this.$loader);
            var _loader = this.$loader;
            setTimeout(function() {
                this.$loader.remove(), this.$element.append(_loader)
            }.bind(this), 300), this.$loader.fadeIn(), $.isFunction(this.options.onRefresh) && this.options.onRefresh(this)
        } else {
            var _this = this;
            this.$loader.fadeOut(function() {
                if ($(this).remove(), "circle-lg" == _this.options.progress) {
                    var iconNew = toggle.find(".active"),
                        iconOld = toggle.find(".fade");
                    iconNew.removeClass("active"), iconOld.removeClass("fade"), toggle.removeClass("refreshing")
                }
                _this.options.refresh = !1
            })
        }
    }, Card.prototype.error = function(error) {
        if (error) {
            var _this = this;
            this.$element.pgNotification({
                style: "bar",
                message: error,
                position: "top",
                timeout: 0,
                type: "danger",
                onShown: function() {
                    _this.$loader.find("> div").fadeOut()
                },
                onClosed: function() {
                    _this.refresh(!1)
                }
            }).show()
        }
    };
    var old = $.fn.card;
    $.fn.card = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data("pg.card"),
                options = "object" == typeof option && option;
            data || $this.data("pg.card", data = new Card(this, options)), "string" == typeof option ? data[option]() : options.hasOwnProperty("refresh") ? data.refresh(options.refresh) : options.hasOwnProperty("error") && data.error(options.error)
        })
    }, $.fn.card.Constructor = Card, $.fn.card.defaults = {
        progress: "circle",
        progressColor: "master",
        refresh: !1,
        error: null,
        overlayColor: "255,255,255",
        overlayOpacity: .8,
        refreshButton: '[data-toggle="refresh"]',
        maximizeButton: '[data-toggle="maximize"]',
        collapseButton: '[data-toggle="collapse"]',
        closeButton: '[data-toggle="close"]'
    }, $.fn.card.noConflict = function() {
        return $.fn.card = old, this
    }, $(document).on("click.pg.card.data-api", '[data-toggle="collapse"]', function(e) {
        var $this = $(this),
            $target = $this.closest(".card");
        $this.is("a") && e.preventDefault(), $target.data("pg.card") && $target.card("collapse")
    }), $(document).on("click.pg.card.data-api", '[data-toggle="close"]', function(e) {
        var $this = $(this),
            $target = $this.closest(".card");
        $this.is("a") && e.preventDefault(), $target.data("pg.card") && $target.card("close")
    }), $(document).on("click.pg.card.data-api", '[data-toggle="refresh"]', function(e) {
        var $this = $(this),
            $target = $this.closest(".card");
        $this.is("a") && e.preventDefault(), $target.data("pg.card") && $target.card({
            refresh: !0
        })
    }), $(document).on("click.pg.card.data-api", '[data-toggle="maximize"]', function(e) {
        var $this = $(this),
            $target = $this.closest(".card");
        $this.is("a") && e.preventDefault(), $target.data("pg.card") && $target.card("maximize")
    }), $(window).on("load", function() {
        $('[data-pages="card"]').each(function() {
            var $card = $(this);
            $card.card($card.data())
        })
    })
}(window.jQuery),
function($) {
    "use strict";
    var MobileView = function(element, options) {
        var self = this;
        return self.options = $.extend(!0, {}, $.fn.pgMobileViews.defaults, options), self.element = $(element), self.element.on("click", function(e) {
            e.preventDefault();
            var data = self.element.data(),
                el = $(data.viewPort),
                toView = data.toggleView;
            return null != data.toggleView ? (el.children().last().children(".view").hide(), $(data.toggleView).show()) : toView = el.last(), el.toggleClass(data.viewAnimation), self.options.onNavigate(toView, data.viewAnimation), !1
        }), this
    };
    $.fn.pgMobileViews = function(options) {
        return new MobileView(this, options)
    }, $.fn.pgMobileViews.defaults = {
        onNavigate: function(view, animation) {}
    }, $(window).on("load", function() {
        $('[data-navigate="view"]').each(function() {
            $(this).pgMobileViews()
        })
    })
}(window.jQuery),
function($) {
    "use strict";
    var Quickview = function(element, options) {
        this.$element = $(element), this.options = $.extend(!0, {}, $.fn.quickview.defaults, options), this.bezierEasing = [.05, .74, .27, .99];
        var _this = this;
        $(this.options.notes).on("click", ".list > ul > li", function(e) {
            var note = $(this).find(".note-preview"),
                note = $(this).find(".note-preview");
            $(_this.options.noteEditor).html(note.html()), $(_this.options.notes).toggleClass("push")
        }), $(this.options.notes).on("click", ".list > ul > li .checkbox", function(e) {
            e.stopPropagation()
        }), $(this.options.notes).on("click", _this.options.backButton, function(e) {
            $(_this.options.notes).find(".toolbar > li > a").removeClass("active"), $(_this.options.notes).toggleClass("push")
        }), $(this.options.deleteNoteButton).click(function(e) {
            e.preventDefault(), $(this).toggleClass("selected"), $(_this.options.notes).find(".list > ul > li .checkbox").fadeToggle("fast"), $(_this.options.deleteNoteConfirmButton).fadeToggle("fast").removeClass("hide")
        }), $(this.options.newNoteButton).click(function(e) {
            e.preventDefault(), $(_this.options.noteEditor).html("")
        }), $(this.options.deleteNoteConfirmButton).click(function() {
            $(_this.options.notes).find("input[type=checkbox]:checked").each(function() {
                $(this).parents("li").remove()
            })
        }), $(this.options.notes).on("click", ".toolbar > li > a", function(e) {
            var command = $(this).attr("data-action");
            document.execCommand(command, !1, null), $(this).toggleClass("active")
        })
    };
    Quickview.VERSION = "1.0.0";
    var old = $.fn.quickview;
    $.fn.quickview = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data("pg.quickview"),
                options = "object" == typeof option && option;
            data || $this.data("pg.quickview", data = new Quickview(this, options)), "string" == typeof option && data[option]()
        })
    }, $.fn.quickview.Constructor = Quickview, $.fn.quickview.defaults = {
        notes: "#note-views",
        alerts: "#alerts",
        chat: "#chat",
        notesList: ".list",
        noteEditor: ".quick-note-editor",
        deleteNoteButton: ".delete-note-link",
        deleteNoteConfirmButton: ".btn-remove-notes",
        newNoteButton: ".new-note-link",
        backButton: ".close-note-link"
    }, $.fn.quickview.noConflict = function() {
        return $.fn.quickview = old, this
    }, $(window).on("load", function() {
        $('[data-pages="quickview"]').each(function() {
            var $quickview = $(this);
            $quickview.quickview($quickview.data())
        })
    }), $(document).on("click.pg.quickview.data-api touchstart", '[data-toggle="quickview"]', function(e) {
        var elem = $(this).attr("data-toggle-element");
        $(elem).toggleClass("open"), e.preventDefault()
    })
}(window.jQuery),
function($) {
    "use strict";
    var Parallax = function(element, options) {
        if (this.$element = $(element), this.options = $.extend(!0, {}, $.fn.parallax.defaults, options), this.$coverPhoto = this.$element.find(".cover-photo"), this.$content = this.$element.find(".inner"), this.$coverPhoto.find("> img").length) {
            var img = this.$coverPhoto.find("> img");
            this.$coverPhoto.css("background-image", "url(" + img.attr("src") + ")"), img.remove()
        }
    };
    Parallax.VERSION = "1.0.0", Parallax.prototype.animate = function() {
        var scrollPos, opacityKeyFrame = 50 * this.$element.height() / 100;
        scrollPos = $(this.options.scrollElement).scrollTop(), this.$coverPhoto.css({
            transform: "translateY(" + scrollPos * this.options.speed.coverPhoto + "px)"
        }), this.$content.css({
            transform: "translateY(" + scrollPos * this.options.speed.content + "px)"
        }), scrollPos > opacityKeyFrame ? this.$content.css({
            opacity: 1 - scrollPos / 1200
        }) : this.$content.css({
            opacity: 1
        })
    };
    var old = $.fn.parallax;
    $.fn.parallax = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data("pg.parallax"),
                options = "object" == typeof option && option;
            data || $this.data("pg.parallax", data = new Parallax(this, options)), "string" == typeof option && data[option]()
        })
    }, $.fn.parallax.Constructor = Parallax, $.fn.parallax.defaults = {
        speed: {
            coverPhoto: .3,
            content: .17
        },
        scrollElement: window
    }, $.fn.parallax.noConflict = function() {
        return $.fn.parallax = old, this
    }, $(window).on("load", function() {
        $('[data-pages="parallax"]').each(function() {
            var $parallax = $(this);
            $parallax.parallax($parallax.data())
        })
    }), $(window).on("scroll", function() {
        Modernizr.touch || $('[data-pages="parallax"]').parallax("animate")
    })
}(window.jQuery),
function($) {
    "use strict";
    var Sidebar = function(element, options) {
        function toggleMenuPin() {
            $(window).width() < 1200 ? $("body").hasClass("menu-pin") && ($("body").removeClass("menu-pin"), $("body").addClass("menu-unpinned")) : $("body").hasClass("menu-unpinned") && $("body").addClass("menu-pin")
        }
        if (this.$element = $(element), this.$body = $("body"), this.options = $.extend(!0, {}, $.fn.sidebar.defaults, options), this.bezierEasing = [.05, .74, .27, .99], this.cssAnimation = !0, this.css3d = !0, this.sideBarWidth = 280, this.sideBarWidthCondensed = 210, this.$sidebarMenu = this.$element.find(".sidebar-menu > ul"), this.$pageContainer = $(this.options.pageContainer), this.$sidebarMenu.length) {
            "desktop" == $.Pages.getUserAgent() && this.$sidebarMenu.scrollbar({
                ignoreOverlay: !1,
                disableBodyScroll: 1 == this.$element.data("disableBodyScroll")
            }), Modernizr.csstransitions || (this.cssAnimation = !1), Modernizr.csstransforms3d || (this.css3d = !1), "undefined" == typeof angular && $(document).on("click", ".sidebar-menu a", function(e) {
                if (!1 !== $(this).parent().children(".sub-menu")) {
                    var el = $(this),
                        parent = $(this).parent().parent(),
                        li = $(this).parent(),
                        sub = $(this).parent().children(".sub-menu");
                    li.hasClass("open active") ? (el.children(".arrow").removeClass("open active"), sub.slideUp(200, function() {
                        li.removeClass("open active")
                    })) : (parent.children("li.open").children(".sub-menu").slideUp(200), parent.children("li.open").children("a").children(".arrow").removeClass("open active"), parent.children("li.open").removeClass("open active"), el.children(".arrow").addClass("open active"), sub.slideDown(200, function() {
                        li.addClass("open active")
                    }))
                }
            }), $(".sidebar-slide-toggle").on("click touchend", function(e) {
                e.preventDefault(), $(this).toggleClass("active");
                var el = $(this).attr("data-pages-toggle");
                null != el && $(el).toggleClass("show")
            });
            var _this = this;
            this.$element.bind("mouseenter mouseleave", function(e) {
                var _sideBarWidthCondensed = _this.$body.hasClass("rtl") ? -_this.sideBarWidthCondensed : _this.sideBarWidthCondensed,
                    menuOpenCSS = 1 == this.css3d ? "translate3d(" + _sideBarWidthCondensed + "px, 0,0)" : "translate(" + _sideBarWidthCondensed + "px, 0)";
                if ($.Pages.isVisibleSm() || $.Pages.isVisibleXs()) return !1;
                $(".close-sidebar").data("clicked") || _this.$body.hasClass("menu-pin") || (_this.$element.css({
                    transform: menuOpenCSS
                }), _this.$body.addClass("sidebar-visible"))
            }), this.$pageContainer.bind("mouseover", function(e) {
                var menuClosedCSS = 1 == _this.css3d ? "translate3d(0, 0,0)" : "translate(0, 0)";
                if ($.Pages.isVisibleSm() || $.Pages.isVisibleXs()) return !1;
                void 0 !== e && $(e.target).parent(".page-sidebar").length || _this.$body.hasClass("menu-pin") || ($(".sidebar-overlay-slide").hasClass("show") && ($(".sidebar-overlay-slide").removeClass("show"), $("[data-pages-toggle']").removeClass("active")), _this.$element.css({
                    transform: menuClosedCSS
                }), _this.$body.removeClass("sidebar-visible"))
            }), $(document).bind("ready", toggleMenuPin), $(window).bind("resize", toggleMenuPin)
        }
    };
    Sidebar.prototype.toggleSidebar = function(toggle) {
        var timer, bodyColor = $("body").css("background-color");
        $(".page-container").css("background-color", bodyColor), this.$body.hasClass("sidebar-open") ? (this.$body.removeClass("sidebar-open"), timer = setTimeout(function() {
            this.$element.removeClass("visible")
        }.bind(this), 400)) : (clearTimeout(timer), this.$element.addClass("visible"), setTimeout(function() {
            this.$body.addClass("sidebar-open")
        }.bind(this), 10), setTimeout(function() {
            $(".page-container").css({
                "background-color": ""
            })
        }, 1e3))
    }, Sidebar.prototype.togglePinSidebar = function(toggle) {
        "hide" == toggle ? this.$body.removeClass("menu-pin") : "show" == toggle ? this.$body.addClass("menu-pin") : this.$body.toggleClass("menu-pin")
    };
    var old = $.fn.sidebar;
    $.fn.sidebar = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data("pg.sidebar"),
                options = "object" == typeof option && option;
            data || $this.data("pg.sidebar", data = new Sidebar(this, options)), "string" == typeof option && data[option]()
        })
    }, $.fn.sidebar.Constructor = Sidebar, $.fn.sidebar.defaults = {
        pageContainer: ".page-container"
    }, $.fn.sidebar.noConflict = function() {
        return $.fn.sidebar = old, this
    }, $(document).on("click.pg.sidebar.data-api", '[data-toggle-pin="sidebar"]', function(e) {
        $(this);
        return $('[data-pages="sidebar"]').data("pg.sidebar").togglePinSidebar(), !1
    }), $(document).on("click.pg.sidebar.data-api touchstart", '[data-toggle="sidebar"]', function(e) {
        $(this);
        return $('[data-pages="sidebar"]').data("pg.sidebar").toggleSidebar(), !1
    })
}(window.jQuery),
function($) {
    "use strict";
    var Search = function(element, options) {
        this.$element = $(element), this.options = $.extend(!0, {}, $.fn.search.defaults, options), this.init()
    };
    Search.VERSION = "1.0.0", Search.prototype.init = function() {
        var _this = this;
        this.pressedKeys = [], this.ignoredKeys = [], this.$searchField = this.$element.find(this.options.searchField), this.$closeButton = this.$element.find(this.options.closeButton), this.$suggestions = this.$element.find(this.options.suggestions), this.$brand = this.$element.find(this.options.brand), this.$searchField.on("keyup", function(e) {
            _this.$suggestions && _this.$suggestions.html($(this).val())
        }), this.$searchField.on("keyup", function(e) {
            if (_this.options.onKeyEnter && _this.options.onKeyEnter(_this.$searchField.val()), 13 == e.keyCode && (e.preventDefault(), _this.options.onSearchSubmit && _this.options.onSearchSubmit(_this.$searchField.val())), $("body").hasClass("overlay-disabled")) return 0
        }), this.$closeButton.on("click", function() {
            _this.toggleOverlay("hide")
        }), this.$element.on("click", function(e) {
            "search" == $(e.target).data("pages") && _this.toggleOverlay("hide")
        }), $(document).on("keypress.pg.search", function(e) {
            _this.keypress(e)
        }), $(document).on("keyup", function(e) {
            _this.$element.is(":visible") && 27 == e.keyCode && _this.toggleOverlay("hide")
        })
    }, Search.prototype.keypress = function(e) {
        var nodeName = (e = e || event).target.nodeName;
        $("body").hasClass("overlay-disabled") || $(e.target).hasClass("js-input") || "INPUT" == nodeName || "TEXTAREA" == nodeName || 0 === e.which || 0 === e.charCode || e.ctrlKey || e.metaKey || e.altKey || 27 == e.keyCode || this.toggleOverlay("show", String.fromCharCode(e.keyCode | e.charCode))
    }, Search.prototype.toggleOverlay = function(action, key) {
        var _this = this;
        "show" == action ? (this.$element.removeClass("hide"), this.$element.fadeIn("fast"), this.$searchField.is(":focus") || (this.$searchField.val(key), setTimeout(function() {
            this.$searchField.focus();
            var tmpStr = this.$searchField.val();
            this.$searchField.val(""), this.$searchField.val(tmpStr)
        }.bind(this), 10)), this.$element.removeClass("closed"), this.$brand.toggleClass("invisible"), $(document).off("keypress.pg.search")) : (this.$element.fadeOut("fast").addClass("closed"), this.$searchField.val("").blur(), setTimeout(function() {
            this.$element.is(":visible") && this.$brand.toggleClass("invisible"), $(document).on("keypress.pg.search", function(e) {
                _this.keypress(e)
            })
        }.bind(this), 10))
    };
    var old = $.fn.search;
    $.fn.search = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data("pg.search"),
                options = "object" == typeof option && option;
            data || $this.data("pg.search", data = new Search(this, options)), "string" == typeof option && data[option]()
        })
    }, $.fn.search.Constructor = Search, $.fn.search.defaults = {
        searchField: '[data-search="searchField"]',
        closeButton: '[data-search="closeButton"]',
        suggestions: '[data-search="suggestions"]',
        brand: '[data-search="brand"]'
    }, $.fn.search.noConflict = function() {
        return $.fn.search = old, this
    }, $(document).on("click.pg.search.data-api", '[data-toggle="search"]', function(e) {
        var $this = $(this),
            $target = $('[data-pages="search"]');
        $this.is("a") && e.preventDefault(), $target.data("pg.search").toggleOverlay("show")
    })
}(window.jQuery),
function($) {
    "use strict";
    "undefined" == typeof angular && $.Pages.init()
}(window.jQuery);