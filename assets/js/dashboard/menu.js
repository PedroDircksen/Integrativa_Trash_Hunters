/**
*
* Script de perfil
*
* @author Emprezaz
*
**/
(function($, PATH, Helpers){

	var responsive = function(){
		$('body').on('click', '.bars', function(){
			$('aside').toggleClass('sidebar-open');
		})
	}

    function toggleFullScreen() {
        /*
         * Fullscreen Browsing
         */
        if ($('[data-action="fullscreen"]')[0]) {
            var fs = $("[data-action='fullscreen']");
            fs.on('click', function(e) {
                e.preventDefault();
    
                //Launch
                function launchIntoFullscreen(element) {
    
                    if (element.requestFullscreen) {
                        element.requestFullscreen();
                    } else if (element.mozRequestFullScreen) {
                        element.mozRequestFullScreen();
                    } else if (element.webkitRequestFullscreen) {
                        element.webkitRequestFullscreen();
                    } else if (element.msRequestFullscreen) {
                        element.msRequestFullscreen();
                    }
                }
    
                //Exit
                function exitFullscreen() {
    
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
    
                launchIntoFullscreen(document.documentElement);
                fs.closest('.dropdown').removeClass('open');
            });
        }
    
    }

    var toggleProductMenu = function () {
        $('body').on('click', '.toggle-product', function () {
            $('#options-product').toggleClass('hidden-product');
        })
        $('body').on('click', '.toggle-fishgame', function () {
            
            $('#fishinggame').toggleClass('hidden-fishinggame');
        })
        $('body').on('click', '.toggle-config', function () {
            
            $('#config').toggleClass('hidden-config');
        })
    }

	$(document).ready(function() {
        toggleProductMenu();
        responsive();
        toggleFullScreen();
	});

})($, PATH, Helpers);