<div class="container-fluid">
    <div class="well well-sm text-center">
    <div class="text-center">
        <h5 class="bold left" id="today_deal">Today's Deals Under 20</h5>
        
        <div class="scroller"><svg class="arrow leftArrow" width="56" height="92"><path class="icon svgArrow" d="M 48 1 L 2 43.26893433745849 M 45.64071092134583 88 L 2 43.26893433745849"></path></svg>
            <div class="items-wrapper">
                <ul class="items">
                <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/straws.png" alt=""/></a> <h4 class="bold">Straws</h4> <h5 class="bold">$3.12</h5><?php include ('countdown.php');?></li> 
                        <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/sharpie-black.png" alt=""/></a> <h4 class="bold">Black Sharpies</h4> <h5 class="bold">$2.99</h5></li> 
                    <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/sharpie.png" alt=""/></a> <h4 class="bold">Sharpie</h4> <h5 class="bold">$2.99</h5><div id="clock2"></div></li> 
                    <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/watch-adv.png" alt=""/></a> <h4 class="bold">Advengers Watch</h4> <h5 class="bold">$5.99</h5></li> 
                      <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/crayon.png" alt=""/></a> <h4 class="bold">Crayons</h4> <h5 class="bold">$4.99</h5></li> 
                      
                       <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/straws.png" alt=""/></a> <h4 class="bold">Straws</h4> <h5 class="bold">$3.12</h5><?php include ('countdown.php');?></li> 
                        <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/sharpie-black.png" alt=""/></a> <h4 class="bold">Black Sharpies</h4> <h5 class="bold">$2.99</h5></li> 
                    <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/sharpie.png" alt=""/></a> <h4 class="bold">Sharpie</h4> <h5 class="bold">$2.99</h5><div id="clock2"></div></li> 
                    <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/watch-adv.png" alt=""/></a> <h4 class="bold">Advengers Watch</h4> <h5 class="bold">$5.99</h5></li> 
                      <li><a href="https://www.amazon.com" target="_blank"><img class="image-horo" width="200" height="160" src="images/crayon.png" alt=""/></a> <h4 class="bold">Crayons</h4> <h5 class="bold">$4.99</h5></li>  
                </ul>
            </div><svg class="arrow rightArrow" width="56" height="92"><path class="icon svgArrow" d="M 2 1 L 48 43.26893433745849 M 4.359289078654172 88 L 48 43.26893433745849"></path></svg></div>
    </div>
</div>

    <script>
'use strict';

var imgScroller;

var initScroller = function initScroller() {
  return imgScroller = Scroller(document.querySelector('.scroller'));
};

setTimeout(initScroller, 500);

function Scroller(el) {
  var wrapper,
      itemList,
      leftBtn,
      rightBtn,
      // Elements
  transformMaxPx,
      stepSizePx,
      // Misc scroll coords
  currentXOffset = 0,
      scrollLeft,
      scrollRight; // event fn hooks

  wrapper = el.querySelector('.items-wrapper');
  itemList = el.querySelector('ul.items');
  leftBtn = el.querySelector('.leftArrow');
  rightBtn = el.querySelector('.rightArrow');

  function updateLayout() {
    var wrapperRect = wrapper.getBoundingClientRect();
    var listRect = itemList.getBoundingClientRect();
    var item = itemList.children[0] && itemList.children[0];
    var itemRect = item && item.getBoundingClientRect();
    var totalWidth = listRect && listRect.width;
    var scrollWidth = wrapperRect.width;
    stepSizePx = itemRect.width;
    transformMaxPx = totalWidth - scrollWidth;
    scrollLeft = scroll.bind(null, 'left', stepSizePx);
    scrollRight = scroll.bind(null, 'right', stepSizePx);
    return item;
  }

  function scroll(direction) {
    var tempOffset = currentXOffset;

    if (direction === 'left') {
      currentXOffset += stepSizePx;
    } else {
      //'assume' right scroll - default
      currentXOffset -= stepSizePx;
    }

    if (currentXOffset <= 0 && currentXOffset >= (transformMaxPx + stepSizePx) * -1) {
      // apply transform
      itemList.style.transform = 'translatex(' + currentXOffset + 'px)'; // console.log(`Doing transition ${direction}! currentXOffset=${currentXOffset} transformMaxPx=${transformMaxPx}`);
    } else {
      currentXOffset = tempOffset; // console.log(`Cancelled transition ${direction}! currentXOffset=${currentXOffset} transformMaxPx=${transformMaxPx}`);
    }
  }

  function init() {
    updateLayout();
    leftBtn.addEventListener('click', scrollLeft);
    rightBtn.addEventListener('click', scrollRight);
    itemList.style.transform = 'translatex(0px)';
  }

  function destroy() {
    leftBtn.removeEventListener('click', scrollLeft);
    rightBtn.removeEventListener('click', scrollRight);
  }

  init();
  return {
    'scroll': scroll,
    'destroy': destroy,
    'init': init,
    'debug': {
      updateLayout: updateLayout,
      wrapper: wrapper,
      itemList: itemList,
      stepSizePx: stepSizePx,
      transformMaxPx: transformMaxPx
    }
  };
}
    </script>
