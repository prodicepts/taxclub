//  let correctAnswer = document.getElementById('answer').value;
//  let optionA = document.getElementById('a').value;
//  let optionB = document.getElementById('b').value;
//  let optionC = document.getElementById('c').value;
//  let optionD = document.getElementById('d').value;

//  $('.option').on('click', function(){
//    alert(this.value);
//  })

$(document).ready(function(){
  //to get the next index for pushing questions.
  $('#roundindex').change(function(){
      var dir = $('#roundindex').val();
      if(dir == 0){
        dirc = 'Test Round';
      }else{
        dirc = 'Round '+ dir;
      }
      $('#roundNo').html(dirc);
      $.ajax({
        url:'getData.php',
        method:'post',
        data: 'round=' + dir
      }).done(function(data){
         $('#nextNo').html(data);
         $('#hiddenqn').val(data);

        })  
    })
    $('.chkbox').change(function(e){
      //to select the correct answer and append in option e
      var selectedValue = $(this).val();
      var crctAnswer = $('#'+selectedValue).val();
      $('#answr').val(crctAnswer);
    });
  //   $("#sendForm").click(function() {
  //     $.ajax({
  //            type: "POST",
  //            url: 'nnn.php',
  //            data: $("#qForm").serialize(), // serializes the form's elements.
  //            success: function(data)
  //            {
  //                //alert(data); // show response from the php script.
  //                $('#Response').html(data).fadeOut(2000);
  //                $("#qForm")[0].reset();
  //            }
  //          });
  
  //     return false; // avoid to execute the actual submit of the form.
  // });
  })



function confirmAndRedirect() {
  let ask = confirm('Click Ok to End Current Round and Display Rounds Summary');
  if(ask){
    //location.replace("https://www.w3schools.com");
    window.location.href = "breakdown.php";
  }
  
}
 
 // fetch data from schools table..  
 function loadTableData(){  
    $.ajax({  
      url : "scorelist.php",  
      type : "POST",  
      success:function(data){  
          $("#scorelist").html(data); 
          setTimeout(loadTableData, 3000);
       }  
  });  
}  

let urll = window.location.search;
let searchParams = new URLSearchParams(urll);
const first = searchParams.get('r');
const second = searchParams.get('q');


//load remaining questions
function loadIndex(){
  $.ajax({
    url: "qleft.php",
    type: "POST",
    success:function(data){
      $("#remquestions").html(data);
      //setTimeout(loadIndex, 3000); commented to enable shuffle function properly.
    }
  });
}

//load current question for umpire questions
function loadCurrentQuestion(){
  $.ajax({
    url: "qnext.php",
    type: "POST",
    success:function(data){
      $("#masterq").html(data);
      setTimeout(loadCurrentQuestion, 3000);
    }
  });
}

//load scoreinput stuff
// function scoreInput(){
//   $.ajax({
//     url: "checky.php",
//     type: "POST",
//     success:function(data){
//       $("#scoreInputor").html(data);
//       setTimeout(scoreInput, 2000);
//     }
//   });
// }
//addTwoPoints
function addTwoPoints(x){
  let urll = window.location.search;
  let searchParams = new URLSearchParams(urll);
  const first = searchParams.get('r');
  const second = searchParams.get('q');
  $.ajax({
    url: "processor.php?r="+first+"&q="+second,
    type: "GET",
    success: function(data){
      //alert(data);
    }
  });

}

//addZeroPoint
function addZeroPoint(){
  let urll = window.location.search;
  let searchParams = new URLSearchParams(urll);
  const first = searchParams.get('r');
  const second = searchParams.get('q');
  $.ajax({
    url: "processwrong.php?r="+first+"&q="+second,
    type: "GET",
    success: function(data){
     // alert(data);
    }
  });
}


//Toggle Screens
$(document).ready(function(){ 
  $("#remquestions").hide();
  $("#e").hide();
  $('#changeScreen').on('click',
  function() {
    $('#remquestions, .qandIndex').toggle(500,'linear');
  }
);
var element = document.getElementById('options');
  var optiondIV = document.getElementById("optionshield");
  optiondIV.style.height = element.offsetHeight+"px";
});

//$("#e").hide();

//$("#congrat").hide();
$("#nq").on('click', function(){
    timer(20);
    $(".optionshield").fadeOut(1000);
    $("#nq").hide();
})



let timing;
let alarm = document.getElementById("my_audio");
let alarm2 = document.getElementById("my_audio3");
let timer = function(x) {
  let timeElm = document.getElementById('counting');
  timing = setInterval(function(){
    
  
  timeElm.innerHTML = x+'s';
  if(x <= 20) {
      alarm2.play();
     // alarm2.muted = false;
     
  }
  if(x <= 11){
    document.getElementById('counting').style.color = 'red';  
    document.getElementById('timer-count').style.backgroundColor = 'white';
    alarm2.pause();  
    alarm.play();
    alarm.muted = false;
  }
  if(x === 0){
    $(".optionshield").fadeIn(2000);
    $("#e").fadeIn(5000);
    alarm.pause();
    return;
  }
  x --;
},1000 );
}


//load masters screen
loadCurrentQuestion();
//loadQuestions();
loadTableData();  
//load inder
loadIndex();
//load timer;
//timer(30);
function clearAll(){
  alarm2.pause();
  alarm.pause();
  clearInterval(timing);
}

let changeCorrect = (x) =>{
  let elem = document.getElementById(x);
  elem.classList.add("correctAnswer");
}

//options btn
let boo = document.getElementById("boo");
let applause = document.getElementById("applause");
let correctAnswer = document.getElementById('answer');
let a = document.getElementById('a').value;
let b = document.getElementById('b').value;
let c = document.getElementById('c').value;
let d = document.getElementById('d').value;
let e = document.getElementById('e').value;
let optionsArray = {'a':a,'b':b,'c':c,'d': d};
$('.opt').click(function(e){
  let selection = e.target; //the selected button
  let selectedId =  selection.id; //id of the selected button

  const correctId = Object.keys(optionsArray)[Object.values(optionsArray).indexOf(correctAnswer.value)];
    
  
   if(selection.value == correctAnswer.value){
     //document.getElementById(selectedId).style.backgroundColor = 'green';
     $( "."+correctId).addClass('blink-text');
     $("#congrat").fadeIn(2000);
    $("#congrat").fadeOut(2000);
    $(".optionshield").fadeIn(3000);
      applause.play();
      addTwoPoints();
    }else{
     
      if(selection.value === "showAnswer"){
        $( "#"+correctId).addClass('quadrat');
        $(".optionshield").fadeIn(3000);
      }else{
        
        document.getElementById(selectedId).style.backgroundColor = 'red';
        $( "#"+correctId).addClass('quadrat');
        boo.play();
        $(".optionshield").fadeIn(3000);
      }
      addZeroPoint();
      
    }
    clearAll();//stop the timer; pause the applaud/pause the boo audios.

});

