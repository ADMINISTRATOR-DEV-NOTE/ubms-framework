
//충돌방지를 위한 클래스화
var Board = function () {



    this.loadingMsg = "loading";
    this.response;
    this.print_r = function (o) {
        return JSON.stringify(o, null, '\t').replace(/\n/g, '<br>').replace(/\t/g, '&nbsp;&nbsp;&nbsp;');
    };

    this.log = function (id, json) {
        $("#" + id).html((board.print_r(json)));
    };


    this.go = function (url) {
        location.href = url;
    };

    this.re = function () {
        location.reload();
    };

    this.back = function () {
        window.history.go(-1);
    };

    this.bgBlock = function () {
        $("body").append("<div id='BLOCK' class='absolute w_100p h_100p z_5000 back_black'></div>");
        $("#BLOCK").css("position", "absolute");
        $("#BLOCK").css("top", "0");
        $("#BLOCK").css('opacity', '0.5');
        $("#BLOCK").css("z-index", "5000");
        $("#BLOCK").css("width", "100%");
        $("#BLOCK").css("height", parseInt($(document).height()));
    };

    this.bgUnBlock = function () {
        $("#BLOCK").remove();
    };


    this.regularExpression = function (obj, regular, event) {
        if (!(event.keyCode >= 37 && event.keyCode <= 40)) {
            var inputVal = $(obj).val();
            $(obj).val(inputVal.replace(regular, ""));
        }
    };
//    this.isLogin = function () {
//        var res = board.request("/member/isLogin");
//        if (res.result === false) {
//            board.loadMenu("max_w400", "/part/login");
//            return false;
//        }
//        return true;
//    };



//    this.isAutoLogin = function () {
//        var res = board.request("/member/isLogin");
//        if (res.result === false) {
//            return false;
//        }
//        return true;
//    };



    this.request = function (url, mapData) {
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: JSON.stringify(mapData),
            async: false,
            beforeSend: function (xhr) {

            },
            complete: function (xhr, status) {

            }
        }).fail(function (data, textStatus, xhr) {
            console.log("error", data.status);
        }).done(function (data) {
            board.response = data;
        });
        return board.response;
    };

    this.swapPage = function (url, target, completeFunc) {
        $.ajax({
            url: url,
            method: "POST",
            dataType: "html",
            async: false,
            beforeSend: function (xhr) {

            },
            complete: function (xhr, status) {
                if (completeFunc) {
                    completeFunc();
                }

            }
        }).fail(function () {
            alert("error");
        }).done(function (data) {
            board.response = data;
            if (target) {
                $("#" + target).html(data);
            }
        });
    };

    //메뉴창 보이기
    this.showMenu = function (id) {
        $("#" + id).css({
            display: "block"
        });
    };
    //메뉴창 닫기
    this.closeMenu = function (id) {
        $("#" + id).css({
            display: "none"
        });
        board.bgUnBlock();
    };

    this.removeMenu = function (id) {
        $("#" + id).remove();
        board.bgUnBlock();
    };

//게시판 제어 및 팝업레이어 메뉴속페이지불러오기  
    this.loadMenu = function (id, url2, callBackFunction) {


        if (url2) {
            $.ajax({
                type: "POST",
                url: url2,
                dataType: "html",
                async: false,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                crossDomain: false,
                data: {
                },
                cache: false,
                beforeSend: function (xhr) {
                    board.bgBlock();
                    $("#" + id).remove();
                    $("#WRAP").append("<div id='" + id + "' class='" + id + "  m_auto none  ' >loading ... </div>");
                    board.showMenu(id);
                },
                complete: function (xhr, status) {
                    if (callBackFunction) {
                        callBackFunction();
                    }

                }
            }).done(function (data) {
                dataBorder = "<div  class='thumbnail m_auto   h_auto   back_white '  >" + data + "</div>";
                $("#" + id + " .thumbnail").remove();
                $("#" + id).html("");
                $("#" + id).append(dataBorder);
                $("#" + id + " .thumbnail").prepend("<i class='glyphicon glyphicon-remove pull-right' onClick=\"board.closeMenu('" + id + "');\"></i>");

                var top = $("html body").scrollTop() + 100;
                $('html, body').animate({scrollTop: top}, 1000);
            });
        }
    };



    this.loadIframe = function (id, data) {
        var top = $(window).scrollTop();
        var left = (parseInt(window.document.body.offsetWidth) / 2) - (parseInt($("#" + id).width()) / 2);
        board.bgBlock();
        $("#" + id).remove();
        $("body").append("<div id='" + id + "' class='" + id + "  m_auto none absolute z_10000' >loading ... </div>");
        board.showMenu(id);
        dataBorder = "<div  class='thumbnail '" + id + " m_auto  z_10000 h_auto  absolute back_white '  >" + data + "</div>";
        $("#" + id + " .thumbnail").remove();
        $("#" + id).html("");
        $("#" + id).append(dataBorder);
        $("#" + id + " .thumbnail").prepend("<i class='glyphicon glyphicon-remove pull-right' onClick=\"board.closeMenu('" + id + "');\"></i>");
        $("#" + id).css("position", "absolute");
        $("#" + id).css("left", left);
    };



    this.random = function (len) {
        if (len === "") {
            len = 5;
        }
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < len; i++)
        {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    };



};
//end Board Class





var board = new Board();

