$(function() {
    var a = function() {
        $("#divPeriod").touchslider();
        Base.getScript(Gobal.Skin + "/js/mobile/GoodsPicSlider.js",
        function() {
            $("#sliderBox").picslider()
        });
        $("div.pOngoing").click(function() {
            location.href = Gobal.Webpath+"/mobile/mobile/item/" + $(this).attr("codeid")
        })
    };
    Base.getScript(Gobal.Skin + "/js/mobile/PeriodSlider.js", a)
});