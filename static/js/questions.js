    var divs = ["q1", "q2", "q3", "q4", "q5", "q6"];
    var visibleDivId = 1;
    var counter = 1;
   
    function next()
    {
        var dd="x"+counter;
    	if(counter!=20)
    	   counter++;

        document.getElementById(dd).classList.remove("btn-danger");
        document.getElementById(dd).classList.add("btn-info");
        
        toggleVisibility(counter);

    }
     function next1()
    {
   
        var dd="x"+counter;

    	if(counter!=20)
    	   counter++;

    	document.getElementById(dd).classList.remove("btn-danger");
    	document.getElementById(dd).classList.add("btn-success");


    
    toggleVisibility(counter);
    }
    function prev()
    {

    	//alert(counter);
    	if(counter!=1)
    		counter--;



    		//alert(counter);

    	  
    toggleVisibility(counter);
    }

    function toggleVisibility(divId) {
    	counter=divId;
    	var temp="q"+counter;
      visibleDivId=temp;

       for(var i = 0; i < divs.length; i++) 
       {
        divId = divs[i];
        div = document.getElementById(divId);
        if(temp === divId) 
          div.style.display = "block";
         else 
          div.style.display = "none";
        
      
      }
  }
