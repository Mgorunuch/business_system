var level_users = {};
level_users[0] = 0;
level_users[1] = level_users[0] + Math.pow(3,1);
level_users[2] = level_users[1] + Math.pow(3,2);
level_users[3] = level_users[2] + Math.pow(3,3);
level_users[4] = level_users[3] + Math.pow(3,4);
level_users[5] = level_users[4] + Math.pow(3,5);
level_users[6] = level_users[5] + Math.pow(3,6);
level_users[7] = level_users[6] + Math.pow(3,7);
level_users[8] = level_users[7] + Math.pow(3,8);
level_users[9] = level_users[8] + Math.pow(3,9);

function setCalculatorLevel(level, click=false) {
  $this = $('.btn-calculator.level_'+level);
  if($this.hasClass('min-level') || $this.prevAll('.min-level').length == 1) {
    $('.btn-calculator').removeClass('clicked');
    $('.btn-calculator.level_'+level).addClass('clicked');
    if(click) {
      $('.btn-calculator.level_'+level).mouseenter().mouseleave();
    }
    calculate(false);
  }
}

function calculate(min=true) {
  if(min) {
    setMinLevel(document.getElementById('direct_inv').value);
    calculate(false);
  } else {
    var level = $('.btn-calculator.clicked').text();
    level = parseInt(level, 10);

    var level_price = getLevelPrice(level);

    var refer_price = document.getElementById('direct_inv').value * 5;
    $('#calculator_result').text(refer_price + level_price);
  }
}

function getLevelPrice(level) {
  var level_prices = {
    '0': 0,
    '1': 0.25 * Math.pow(3, 1),
    '2': 0.25 * Math.pow(3, 2),
    '3': 0.5 * Math.pow(3, 3),
    '4': 0.5 * Math.pow(3, 4),
    '5': 0.5 * Math.pow(3, 5),
    '6': 0.5 * Math.pow(3, 6),
    '7': 0.5 * Math.pow(3, 7),
    '8': 0.5 * Math.pow(3, 8),
    '9': 0.5 * Math.pow(3, 9)
  };

  switch (level) {
    case 1:
      return level_prices[1];
      break;
    case 2:
      return level_prices[1] + level_prices[2];
      break;
    case 3:
      return level_prices[1] + level_prices[2] + level_prices[3];
      break;
    case 4:
      return level_prices[1] + level_prices[2] + level_prices[3]
      + level_prices[4];
      break;
    case 5:
      return level_prices[1] + level_prices[2] + level_prices[3]
      + level_prices[4] + level_prices[5];
      break;
    case 6:
      return  level_prices[1] + level_prices[2] + level_prices[3]
        + level_prices[4] + level_prices[5] + level_prices[6];
      break;
    case 7:
      return level_prices[1] + level_prices[2] + level_prices[3]
      + level_prices[4] + level_prices[5] + level_prices[6] + level_prices[7];
      break;
    case 8:
      return level_prices[1] + level_prices[2] + level_prices[3]
      + level_prices[4] + level_prices[5] + level_prices[6] + level_prices[7]
      + level_prices[8];
      break;
    case 9:
      return level_price = level_prices[1] + level_prices[2] + level_prices[3]
      + level_prices[4] + level_prices[5] + level_prices[6] + level_prices[7]
      + level_prices[8] + level_prices[9];
      break;
    default:
  }
}

function setMinLevel(users_count) {
  if(users_count > level_users[9]) {
    $('.btn-calculator').removeClass('min-level');
    $('.btn-calculator.level_9').addClass('min-level');
    setCalculatorLevel(9, true);
  } else {
    for(var i = 1; i < 10; i++) {
      if(users_count <= level_users[i] && users_count >= level_users[i-1]) {
        $('.btn-calculator').removeClass('min-level');
        $('.btn-calculator.level_'+i).addClass('min-level');
        setCalculatorLevel(i, true);
        break;
      }
    }
  }
}

$(document).ready(function() {

    //Chrome Smooth Scroll
    try {
        $.browserSelector();
        if($("html").hasClass("chrome")) {
            $.smoothScroll();
        }
    } catch(err) {

    };

    particlesJS.load('particles', '/js/particles/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });

    $('.nav-left').click(function() {
      var $this = $(this);
      var $siblings = $this.siblings('.nav');
      var $active = $this.siblings('.nav.active');
      var active_count = null;

      if(!$active.prev().hasClass('nav-left')) {
        $active.prev().find('a')[0].click();
      }
    });

    $('.nav-right').click(function() {
      var $this = $(this);
      var $siblings = $this.siblings('.nav');
      var $active = $this.siblings('.nav.active');
      var active_count = null;

      if(!$active.next().hasClass('nav-right')) {
        $active.next().find('a')[0].click();
      }
    });

    $('.btn-calculator').on('mouseover', function() {
      var $this = $(this);

      $this.addClass('active');
      $this.prevAll('.btn-calculator').addClass('active');
      $this.nextAll('.btn-calculator').removeClass('active');
    });

    $('.btn-calculator').on('mouseout', function() {
      $this = $('.btn-calculator.clicked');

      $this.addClass('active');
      $this.prevAll('.btn-calculator').addClass('active');
      $this.nextAll('.btn-calculator').removeClass('active');
    });

    var $header_waypoint = $('#header_waypoint');

  	$header_waypoint.waypoint(function(direction) {
  		$('.navbar-fixed-top').toggleClass('active');
  	}, { offset: '-40px'});

  	var head_step = 50;
  	$header_waypoint.waypoint(function(direction) {
  		if(direction == 'up') {
  			$('.fake-head').css({ opacity:1 });
  		} else {
  			$('.fake-head').css({ opacity:.8 });
  		}
  	}, { offset: head_step * -1});

  	$header_waypoint.waypoint(function(direction) {
  		if(direction == 'up') {
  			$('.fake-head').css({ opacity:.8 });
  		} else {
  			$('.fake-head').css({ opacity:.6 });
  		}
  	}, { offset: head_step * 2 * -1});

  	$header_waypoint.waypoint(function(direction) {
  		if(direction == 'up') {
  			$('.fake-head').css({ opacity:.6 });
  		} else {
  			$('.fake-head').css({ opacity:.4 });
  		}
  	}, { offset: head_step * 3 * -1});

  	$header_waypoint.waypoint(function(direction) {
  		if(direction == 'up') {
  			$('.fake-head').css({ opacity:.4 });
  		} else {
  			$('.fake-head').css({ opacity:.2 });
  		}
  	}, { offset: head_step * 4 * -1});

  	$header_waypoint.waypoint(function(direction) {
  		if(direction == 'up') {
  			$('.fake-head').css({ opacity:.2 });
  		} else {
  			$('.fake-head').css({ opacity:0 });
  		}
  	}, { offset: head_step * 5 * -1});
});

$(document).ready(function() {
  var element = $("#counter-changer")
  var numero = element.text();

  function numberAnimation(){
  	element.prop('contador',0).animate({
  		contador: element.text()
  	}, {
  		duration: 1000,
  		easing: 'swing',
  		step: function (now) {
  			// Verificar si es decimal o no
  			var numText = (numero % 1 !== 0 ? now.toFixed(1) : Math.round(now));
  			element.text(numText);
  		}
  	});
  }

  $(document).ready(function(){
  	numberAnimation();
  });
});
