jQuery(document).ready(function($) {
       $('#fullpage').fullpage({
        //Navigation
        menu: '#menu',
        //Add more anchors if required, but i think that 10 will do for the most projects :)
        anchors:['slide1', 'slide2', 'slide3', 'slide4', 'slide5', 'slide6', 'slide7', 'slide8', 'slide9', 'slide10'],
        navigationPosition: 'right',
        navigationTooltips: ['Home', 'About', 'Portfolio', 'slide4', 'slide5', 'slide6', 'slide7', 'slide8', 'slide9', 'slide10'],
        showActiveTooltip: false,
        
            //Scrolling
        css3: true,
        scrollingSpeed: 700,
        autoScrolling: true,
        fitToSection: true,
        fitToSectionDelay: 1000,
        scrollBar: false,

        //Accessibility
        keyboardScrolling: true,

        //Design
        controlArrows: true,
        paddingTop: '3em',
        paddingBottom: '10px',
        fixedElements: '#header, .footer',
        responsiveWidth: 0,
        responsiveHeight: 0,
      
    
   });
});

jQuery(document).ready(function($) {
if ($(window).width() < 960) {
     $('.menu-trigger').click(function() {
    $('nav ul').slideToggle(500);
  });//end slide toggle
   $('nav li').click(function() {
    $('nav ul').slideToggle(100);
  });//end slide toggle
}
else {
   
}
});//end ready