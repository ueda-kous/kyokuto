$(function () {
  site = $("#shopsearch").data("site");
  get_area(site);

  function get_area(id, select) {
    $.ajax({
      url:
        "https://k-cleaning.jp/wp-json/wp/v2/region?_embed&_jsonp=callback&orderby=slug&per_page=100&parent=" +
        id,
      dataType: "jsonp",
      jsonpCallback: "callback",
    })
      // Ajaxリクエストが成功した時発動
      .done((data) => {
        for (var i = 0; i < data.length; i++) {
          var post = data[i];
          var title = post.name;
          var id = post.id;
          var html = '<option value="' + id + '">' + title + "</option>";
          $("#search1").append(html);
        }
        if (select !== void 0) {
          region = select;
        } else {
          region = data[0].id;
        }
      })
      .fail((data) => {})
      .always((data) => {});
  }
});
