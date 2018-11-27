//////////////////////////////////////////////////////////////////////////////////
/* tooltip */

var tooltips = [].slice.call(document.querySelectorAll('.tooltip'));
//var closeToolTips = [].slice.call(document.querySelectorAll('.closeToolTip'));

tooltips.forEach(function(tooltip) {


    tooltip.onclick = function() {

        var tooltiptext = tooltip.querySelector('.tooltiptext');
        tooltiptext.style.visibility = 'visible';



    };



});

window.onclick = function(event) {

    if (event.target.parentNode.className==='tooltiptext') {

        tooltips.forEach(function (tooltip) {
            var tooltiptext = tooltip.querySelector('.tooltiptext');
            tooltiptext.style.visibility = 'hidden';
        });

    }

};

/* end tooltip */