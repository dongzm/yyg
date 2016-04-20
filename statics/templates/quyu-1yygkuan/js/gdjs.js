  $(function(){
	    var _BuyList=$("#buyList");
        var Trundle = function () {
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-85px');
            _BuyList.animate({ 'marginTop': '0px' }, 800);
        }
        var setTrundle = setInterval(Trundle, 3000);
        _BuyList.hover(function () {
            clearInterval(setTrundle);
            setTrundle = null;
        },function () {
            setTrundle = setInterval(Trundle, 3000);
        });
    });