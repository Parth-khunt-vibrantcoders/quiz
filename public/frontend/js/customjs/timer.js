var m=1; //define your minute
var s=0;
var h;
var xx=0;
var width=100/(m*time_second);
//var count=0;
var clearInter;
var tempW=0;

$(function(){
  //s=$('.second').html();
 // m=$('.minute').html();
	minute = m%time_second;
	h= Math.floor(m/ time_second);


$('.hour').html(h);
$('.minute').html(minute);

	clearInter=setInterval(function(){
		timerCal();
	},1000);

});

function timerCal(){
//count++;
//console.log(count);
tempW=tempW+width;

$('.bar-main').css({'width':tempW+'%'});

  /*if((h==0)&&(m==0)&&(s==0)){
  clearInterval(clearInter);
  }*/

  if(s>0){
    	s=s-1;
      //console.log(s);
      if(s<10){
        $('.second').html("0"+s);
      }
      else{
        $('.second').html(s);
      }


 }

  if(s==0){
    s=time_second;
    var ss=s;

    if(xx==0){
      s=89;
      ss=s;
      xx=1;
    }
      $('.second').html(s);
		//console.log(minute);

        if(minute!=0){
          minute=minute-1;
				if(minute<10){
				$('.minute').html("0"+minute);
				}
				else{
				$('.minute').html(minute);
				}

          //$('.minute').html(minute);
        }

          else {
          // alert('fdsf');

			  if(h!=0){
				  h=h-1;
				  minute=89;
				  $('.minute').html(minute);

				  $('.hour').html(h);
			  }

			  else{
			  //alert('sdfs')
			  $('.second').text(00);
				clearInterval(clearInter);
			  }

          }

      }
}
