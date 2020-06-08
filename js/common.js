$("body,html").stop().scrollTop(0);
var hash = window.location.hash;
if (hash !== "") {
  window.location.hash = "";
}
$(function () {
  if (hash !== void 0 && hash !== "") {
    var speed = 600; // ミリ秒
    // アンカーの値取得
    var href = $(this).attr("href");
    // 移動先を取得
    var target = $(hash);
    // 移動先を数値で取得
    var position = target.offset().top;
    // スムーススクロール
    $("body,html").animate({ scrollTop: position }, speed, "swing");
  }
});

$(function () {
  // #で始まるアンカーをクリックした場合に処理
  $('a[href^="#"]').click(function () {
    // スクロールの速度
    var speed = 600; // ミリ秒
    // アンカーの値取得
    var href = $(this).attr("href");
    // 移動先を取得
    var target = $(href == "#" || href == "" ? "html" : href);
    // 移動先を数値で取得
    var position = target.offset().top;
    // スムーススクロール
    $("body,html").animate({ scrollTop: position }, speed, "swing");
    return false;
  });
});

$(function () {
  $("#btnGnavi").click(function () {
    $("#gNavi ul").stop().slideToggle("fast");
  });
});

$(function () {
  var menuBtn = $("#header a.menu-trigger");
  menuBtn.on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $("#gNavi").fadeOut("fast", function () {
        $("#gNavi ul").hide().css({ right: "-100vw" });
      });
    } else {
      $(this).addClass("active");
      $("#gNavi").fadeIn("fast", function () {
        $("#gNavi ul").stop().show().animate({ right: 0 }, "slow");
      });
    }
    return false;
  });
});

$(function () {
  // Send event to Google Analytics
  $('a[href^="tel:"]').click(function () {
    var txt = $(this).attr("href");
    var pathName = $(location).attr("pathname");

    // For Global Site Tag
    gtag("event", "tel", {
      event_category: "sp",
      event_label: txt + ", pageURL:" + pathName,
    });

    // For Universal Analytics
    //ga('send', 'event', 'sp', 'tel', txt+', pageURL:'+pathName);
  });
});

// lazy load
$(function () {
  window.onload = function () {
    init();
    $(window).scroll(lazyFade);
  };

  function init() {
    lazyFade();
  }

  function lazyFade() {
    var scrollTop = $(window).scrollTop();
    var scrollBtm = scrollTop + $(window).height();
    $(".lazy").each(function () {
      var target = $(this);
      var targetTop = target.offset().top;

      if (scrollBtm > targetTop) {
        target.removeClass("lazy");
        target.addClass("lazy-show");
      }
    });
  }
});

// gnavi 固定
$(function () {
  $(window).scroll(fixGnavi);

  function fixGnavi() {
    var width = $(window).width();
    var scrollTop = $(window).scrollTop();
    var gNavi = $("#gNavi");
    var gNaviHeight = gNavi.outerHeight();
    var headerHeight = $("#header").outerHeight();
    if (width > 828 && scrollTop > headerHeight) {
      gNavi.addClass("fixed");
      $("#header").css({ marginTop: gNaviHeight });
    } else {
      gNavi.removeClass("fixed");
      $("#header").css({ marginTop: 0 });
    }
  }
});
