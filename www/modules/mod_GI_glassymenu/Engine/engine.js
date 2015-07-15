dojo.require("dojo.fx.easing");

dojo.declare("glassyMenu", null, {
  constructor: function(args) {
    dojo.mixin(this,args);
    var glassy = dojo.create("div", { id: "glassy_menu_module", innerHTML:this.glassy }, dojo.body());
    this.menu = dojo.query('#glassy_menu_module .menu');
    this.init();
    this.mbl;
    
    if(dojo.isIE < 8){
      dojo.style(dojo.body(),'overflow-y','hidden');
    }
  },
  
  init: function() {
    for (var i=0;i<this.menu.length;i++) {
      var baseHeight = dojo.style(this.menu[i].children[0], 'height').toInt();

      if(this.position==1){
        this.mbl = dojo.style(this.menu[i].children[2], 'width').toInt();
      }else{
        this.mbl = dojo.style(this.menu[i].children[0], 'width').toInt();
      }
      
      dojo.animateProperty({
        node: this.menu[i], 
        //duration: 2000,
        easing: dojo.fx.easing['expoOut'],
        properties: {
          top : (baseHeight+this.menudist)*i+this.menutop
        },
        onEnd: dojo.hitch(this, function(n){
          
           var moveBackTo = this.mbl-dojo.style(n, 'width').toInt();

           if (this.position==1)   
             dojo.animateProperty({
              node: n,
              delay: n.id.match(/menu(.*)/)[1].toInt()*100,
              properties: {
                opacity: this.opacity,
                left: 0 //moveBackTo
              }
            }).play();  
           else
              dojo.animateProperty({
              node: n, 
              delay: n.id.match(/menu(.*)/)[1].toInt()*100,
              properties: {
                opacity: this.opacity,
                right: 0 //moveBackTo
              }
            }).play();                   
        })
      }).play();  
      dojo.connect(this.menu[i], "mouseenter", dojo.hitch(this, "onMouseOver"));
      dojo.connect(this.menu[i], "mouseleave",  dojo.hitch(this, "onMouseOut"));
      
    }
  },
  
  onMouseOver: function(e) {
    var n=e.currentTarget;

    if (this.position==1) {
      dojo.animateProperty({
        node: n, 
        properties: {
          opacity: 1,
          left : 0
        }
      }).play();  
    } else
       dojo.animateProperty({
        node: n, 
        properties: {
          opacity: 1,
          right: 0
        }
      }).play(); 
        
  }, 
  
  onMouseOut: function(e) {
    var n=e.currentTarget;
    var moveBackTo = this.mbl-dojo.style(n, 'width').toInt(); 
    
    if (this.position==1)   
      dojo.animateProperty({
        node: n, 
        properties: {
          opacity: this.opacity,
          left: 0 //moveBackTo
        }
      }).play();  
    else
       dojo.animateProperty({
        node: n, 
        properties: {
          opacity: this.opacity,
          right: 0 //moveBackTo
        }
      }).play(); 
      
    
  
  }     
});