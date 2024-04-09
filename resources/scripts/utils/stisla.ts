export default function initStisla(
  options: {
    /**
     * Enable mini sidebar. default: `false`
     */
    mini: boolean;
  } = { mini: false },
) {
  const sidebar_nicescroll_opts = {
    cursoropacitymin: 0,
    cursoropacitymax: 0.8,
    zindex: 892,
  };
  let now_layout_class: null | string = null;

  const sidebar_sticky = function () {
    if ($("body").hasClass("layout-2")) {
      $("body.layout-2 #sidebar-wrapper").stick_in_parent({
        parent: $("body"),
      });

      $("body.layout-2 #sidebar-wrapper").stick_in_parent({ recalc_every: 1 });
    }
  };
  sidebar_sticky();

  let sidebar_nicescroll: JQueryNiceScroll.NiceScroll | null;

  const update_sidebar_nicescroll = function () {
    const a = setInterval(function () {
      if (sidebar_nicescroll != null) sidebar_nicescroll.resize();
    }, 10);

    setTimeout(function () {
      clearInterval(a);
    }, 600);
  };

  const sidebar_dropdown = function () {
    if ($(".main-sidebar").length) {
      $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
      sidebar_nicescroll = $(".main-sidebar").getNiceScroll();

      $(".main-sidebar .sidebar-menu li a.has-dropdown")
        .off("click")
        .on("click", function () {
          const me = $(this);
          let active = false;
          if (me.parent().hasClass("active")) {
            active = true;
          }

          $(".main-sidebar .sidebar-menu li.active > .dropdown-menu").slideUp(
            500,
            function () {
              update_sidebar_nicescroll();
              return false;
            },
          );

          $(".main-sidebar .sidebar-menu li.active").removeClass("active");

          if (active == true) {
            me.parent().removeClass("active");
            me.parent()
              .find("> .dropdown-menu")
              .slideUp(500, function () {
                update_sidebar_nicescroll();
                return false;
              });
          } else {
            me.parent().addClass("active");
            me.parent()
              .find("> .dropdown-menu")
              .slideDown(500, function () {
                update_sidebar_nicescroll();
                return false;
              });
          }

          return false;
        });

      $(
        ".main-sidebar .sidebar-menu li a.nav-link:not(.dropdown-menu a.nav-link):not(.has-dropdown)",
      )
        .off("click")
        .on("click", function () {
          const me = $(this);

          $(".main-sidebar .sidebar-menu li.active > .dropdown-menu").slideUp(
            500,
            function () {
              update_sidebar_nicescroll();
              return false;
            },
          );

          $(".main-sidebar .sidebar-menu li.active").removeClass("active");

          me.parent().addClass("active");
        });

      $(".main-sidebar .sidebar-menu li.active > .dropdown-menu").slideDown(
        500,
        function () {
          update_sidebar_nicescroll();
          return false;
        },
      );
    }
  };
  sidebar_dropdown();

  $(".main-content").css({
    minHeight: $(window).outerHeight()
      ? ($(window).outerHeight() as number) - 108
      : 0,
  });

  $(".nav-collapse-toggle").click(function () {
    $(this).parent().find(".navbar-nav").toggleClass("show");
    return false;
  });

  $(document).on("click", function () {
    $(".nav-collapse .navbar-nav").removeClass("show");
  });

  const toggle_sidebar_mini = function (mini: boolean) {
    const body = $("body");

    if (!mini) {
      body.removeClass("sidebar-mini");
      $(".main-sidebar").css({
        overflow: "hidden",
      });
      setTimeout(function () {
        $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
        sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
      }, 500);
      $(".main-sidebar .sidebar-menu > li > ul .dropdown-title").remove();
      $(".main-sidebar .sidebar-menu > li > a").removeAttr("data-toggle");
      $(".main-sidebar .sidebar-menu > li > a").removeAttr(
        "data-original-title",
      );
      $(".main-sidebar .sidebar-menu > li > a").removeAttr("title");
    } else {
      body.addClass("sidebar-mini");
      body.removeClass("sidebar-show");

      if (sidebar_nicescroll) {
        sidebar_nicescroll.remove();
      }

      sidebar_nicescroll = null;

      $(".main-sidebar .sidebar-menu > li").each(function () {
        const me = $(this);

        if (me.find("> .dropdown-menu").length) {
          me.find("> .dropdown-menu").hide();
          me.find("> .dropdown-menu").prepend(
            '<li class="dropdown-title pt-3">' +
              me.find("> a").text() +
              "</li>",
          );
        } else {
          me.find("> a").attr("data-toggle", "tooltip");
          me.find("> a").attr("data-original-title", me.find("> a").text());

          $("[data-toggle='tooltip']").tooltip({
            placement: "right",
          });
        }
      });
    }
  };

  $("[data-toggle='sidebar']").on("click", function () {
    const body = $("body");
    const outerWidth = $(window).outerWidth();

    if (outerWidth && outerWidth <= 1024) {
      body.removeClass("search-show search-gone");
      if (body.hasClass("sidebar-gone")) {
        body.removeClass("sidebar-gone");
        body.addClass("sidebar-show");
      } else {
        body.addClass("sidebar-gone");
        body.removeClass("sidebar-show");
      }

      update_sidebar_nicescroll();
    } else {
      body.removeClass("search-show search-gone");
      if (body.hasClass("sidebar-mini")) {
        toggle_sidebar_mini(false);
      } else {
        toggle_sidebar_mini(true);
      }
    }

    return false;
  });

  const toggleLayout = function () {
    const outerWidth = $(window).outerWidth();
    const layout_class = ($("body").attr("class") || "").trim();
    const layout_classes = layout_class.split(" ");

    if (layout_class.length > 0 && layout_classes.length > 0) {
      layout_classes.forEach(function (item) {
        if (item.indexOf("layout-") != -1) {
          now_layout_class = item;
        }
      });
    }

    if (outerWidth && outerWidth <= 1024) {
      if ($("body").hasClass("sidebar-mini")) {
        toggle_sidebar_mini(false);
        $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
        sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
      }

      $("body").addClass("sidebar-gone");
      $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
      $("body")
        .off("click touchend")
        .on("click touchend", function (e) {
          if (
            $(e.target).hasClass("sidebar-show") ||
            $(e.target).hasClass("search-show")
          ) {
            $("body").removeClass("sidebar-show");
            $("body").addClass("sidebar-gone");
            $("body").removeClass("search-show");

            update_sidebar_nicescroll();
          }
        });

      update_sidebar_nicescroll();

      if (now_layout_class == "layout-3") {
        const nav_second_classes = $(".navbar-secondary").attr("class");
        const nav_second = $(".navbar-secondary");

        nav_second.attr("data-nav-classes", nav_second_classes || "");
        nav_second.removeAttr("class");
        nav_second.addClass("main-sidebar");

        const main_sidebar = $(".main-sidebar");

        main_sidebar
          .find(".container")
          .addClass("sidebar-wrapper")
          .removeClass("container");
        main_sidebar
          .find(".navbar-nav")
          .addClass("sidebar-menu")
          .removeClass("navbar-nav");
        main_sidebar.find(".sidebar-menu .nav-item.dropdown.show a").click();
        main_sidebar.find(".sidebar-brand").remove();
        main_sidebar.find(".sidebar-menu").before(
          $("<div>", {
            class: "sidebar-brand",
          }).append(
            $("<a>", {
              href: $(".navbar-brand").attr("href"),
            }).html($(".navbar-brand").html()),
          ),
        );
        setTimeout(function () {
          sidebar_nicescroll = main_sidebar.niceScroll(sidebar_nicescroll_opts);
          sidebar_nicescroll = main_sidebar.getNiceScroll();
        }, 700);

        sidebar_dropdown();
        $(".main-wrapper").removeClass("container");
      }
    } else {
      $("body").removeClass("sidebar-gone sidebar-show");
      if (now_layout_class) $("body").addClass(now_layout_class);

      const nav_second_classes = $(".main-sidebar").attr("data-nav-classes");
      const nav_second = $(".main-sidebar");

      if (
        now_layout_class == "layout-3" &&
        nav_second.hasClass("main-sidebar")
      ) {
        nav_second.find(".sidebar-menu li a.has-dropdown").off("click");
        nav_second.find(".sidebar-brand").remove();
        nav_second.removeAttr("class");
        nav_second.addClass(nav_second_classes || "");

        const main_sidebar = $(".navbar-secondary");

        main_sidebar
          .find(".sidebar-wrapper")
          .addClass("container")
          .removeClass("sidebar-wrapper");
        main_sidebar
          .find(".sidebar-menu")
          .addClass("navbar-nav")
          .removeClass("sidebar-menu");
        main_sidebar.find(".dropdown-menu").hide();
        main_sidebar.removeAttr("style");
        main_sidebar.removeAttr("tabindex");
        main_sidebar.removeAttr("data-nav-classes");
        $(".main-wrapper").addClass("container");
        // if(sidebar_nicescroll != null)
        //   sidebar_nicescroll.remove();
      } else if (now_layout_class == "layout-2") {
        $("body").addClass("layout-2");
      } else {
        update_sidebar_nicescroll();
      }
    }
  };
  toggleLayout();
  $(window).on("resize", toggleLayout);

  // Set auto mini sidebar
  setTimeout(() => {
    const outerHeight = $(window).outerWidth();

    if (
      options.mini &&
      outerHeight &&
      outerHeight > 1024 &&
      !$("body").hasClass("sidebar-mini")
    ) {
      $("[data-toggle='sidebar']").first()?.trigger("click");
    }
  }, 50);

  // tooltip
  $("[data-toggle='tooltip']").tooltip();

  // popover
  $('[data-toggle="popover"]').popover({
    container: "body",
  });

  $(".notification-toggle").dropdown();
  $(".notification-toggle")
    .parent()
    .on("shown.bs.dropdown", function () {
      $(".dropdown-list-icons").niceScroll({
        cursoropacitymin: 0.3,
        cursoropacitymax: 0.8,
        cursorwidth: "7",
      });
    });

  $(".message-toggle").dropdown();
  $(".message-toggle")
    .parent()
    .on("shown.bs.dropdown", function () {
      $(".dropdown-list-message").niceScroll({
        cursoropacitymin: 0.3,
        cursoropacitymax: 0.8,
        cursorwidth: "7",
      });
    });

  // Follow function
  $(".follow-btn, .following-btn").each(function () {
    const me = $(this);
    const follow_text = "Follow";
    const unfollow_text = "Following";

    me.click(function () {
      if (me.hasClass("following-btn")) {
        me.removeClass("btn-danger");
        me.removeClass("following-btn");
        me.addClass("btn-primary");
        me.html(follow_text);

        Function(me.data("unfollow-action"))();
      } else {
        me.removeClass("btn-primary");
        me.addClass("btn-danger");
        me.addClass("following-btn");
        me.html(unfollow_text);

        Function(me.data("follow-action"))();
      }
      return false;
    });
  });

  // Dismiss function
  $("[data-dismiss]").each(function () {
    const me = $(this);
    const target = me.data("dismiss");

    me.click(function () {
      $(target).fadeOut(function () {
        $(target).remove();
      });
      return false;
    });
  });

  // Collapsable
  $("[data-collapse]").each(function () {
    const me = $(this);
    const target = me.data("collapse");

    me.on("click", function () {
      $(target).collapse("toggle");

      $(target).on("shown.bs.collapse", function (e) {
        e.stopPropagation();
        me.html('<i class="fas fa-minus"></i>');
      });

      $(target).on("hidden.bs.collapse", function (e) {
        e.stopPropagation();
        me.html('<i class="fas fa-plus"></i>');
      });

      return false;
    });
  });

  // Background
  $("[data-background]").each(function () {
    const me = $(this);

    me.css({
      backgroundImage: "url(" + me.data("background") + ")",
    });
  });

  // Custom Tab
  $("[data-tab]").each(function () {
    const me = $(this);

    me.on("click", function () {
      if (!me.hasClass("active")) {
        const tab_group_active = $(
          '[data-tab-group="' + me.data("tab") + '"].active',
        );
        const target = $(me.attr("href") || "");
        const links = $('[data-tab="' + me.data("tab") + '"]');

        links.removeClass("active");
        me.addClass("active");
        target.addClass("active");
        tab_group_active.removeClass("active");
      }

      return false;
    });
  });

  // alert dismissible
  $(".alert-dismissible").each(function () {
    const me = $(this);

    me.find(".close").click(function () {
      me.alert("close");
    });
  });

  // Image cropper
  $("[data-crop-image]").each(function () {
    $(this).css({
      overflow: "hidden",
      position: "relative",
      height: $(this).data("crop-image"),
    });
  });

  // Dismiss modal
  $("[data-dismiss=modal]").on("click", function () {
    $(this).closest(".modal").modal("hide");

    return false;
  });

  // Width attribute
  $("[data-width]").each(function () {
    $(this).css({
      width: $(this).data("width"),
    });
  });

  // Height attribute
  $("[data-height]").each(function () {
    $(this).css({
      height: $(this).data("height"),
    });
  });
}
