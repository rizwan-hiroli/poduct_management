@include('layouts.nav')

<!-- Include Required Prerequisites -->
<head>
    
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" /> -->
     
    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <style type="text/css">
      #dp{
        margin-left:20px;

      }
    </style>
</head>
<!-- <div class="container">         -->
      

        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        
        <h2>STATISTICS</h2>

        <!-- Adding daterange picker -->
        <div class="col-xs-4 pull-right">
          <input type="text" class=" form-control " id="dp" name="daterange" />&nbsp;
          
        </div>
        <!-- @if(! Auth::user()->is_admin)
            <div id="forDropDown" class="forDropDown">this is dropdown</div>
        @endif -->
        <div class="dropdown pull-right">
            <button data-value="all" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select User 
              <span class="caret"></span>
            </button>
            
            <ul class="dropdown-menu list-group" aria-labelledby="dropdownMenu1">
              @if(Auth::user()->is_admin)
              <li style="cursor: pointer;" data-value="summary" class="list-group-item ">Summary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li style="cursor: pointer;" data-value="all" class="list-group-item ">All Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              
              <!-- getting all users name and id from controller -->
              @foreach($users as $user)
                <!-- display list with username and  mapping id of user with data-value of html -->
                <li style="cursor: pointer;" data-value="{{$user->id}}" class="list-group-item ">{{ $user->name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              @endforeach
              @endif
              @if(!Auth::user()->is_admin)
                  
                <li   style="cursor: pointer;" data-value="{{Auth::user()->id}}" class="list-group-item forDropDown">    {{Auth::user()->name}}</li>
                
              @endif    
            </ul>

        </div>
        <br><br><br>
        
		


        <table class="table table-bordered" id="mydata">
            <tr>
                <th>Name</th>
                <th id="th_2">Date</th>
                <th id="th_3">Price (Rs.)</th>
                <th>Quantity</th>
                <th>Total (Rs.)</th>
            </tr>
            
        </table>
  
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script type="text/javascript">
    
    var id;
    // making the li dropdown populated with name of the users from db
    $(".dropdown-menu li").click(function(){
      // getting into dropdown class then find the button i.e default button adding the caret additionaly 
      $(this).parents(".dropdown")
      $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
      // replace its text with selected li text
      $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
      id= $(this).attr('data-value');
    });
 
    // if($(".forDropDown")){
    //    $(".dropdown").hide();
    // }

    $('input[name="daterange"]').daterangepicker({ //name of html filed
            locale: {
              format: 'MMMM D, YYYY' //formattting the data
            },
            startDate:moment(),//moment() //mention default date to be displayed 
            endDate: moment(),//moment().add('d', 1).toDate()
            ranges: {
                   'Today': [moment(), moment()],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()]
                    }
        });
// if(!Auth::user()->is_admin){
// $(".dropdown-menu").hide();
// }
$(".dropdown .dropdown-menu li ")[0].click();

//$('.applyBtn').on('click', function() {
    // $('input[name="daterange"]').change(
     function change(e) {

    //this buton removes all the <td> before loading the data so previous data wont get append
    jQuery('td').remove(); 
    // setting up ajax call
    $.ajax({
       dataType : "json",
       type: "post",
       data: { 
            'start': $('input[name="daterange"]').val(), //getting the value and store in start variable for further processing
            '_token' : $('#_token').val(), //sending the token field as well
            'id':id
        },
       url: "/showstats",
       
       
       success: function(data) {
            //getting the data from controller and access it via json array
            //data is json name ,product is another json inside data
            //var price=data.product.price;   
            var counter=0;
            flag=false; //setting the flag to know if date is fetched form db
            flagfornodata=false;
            //$(this).closest('tr').remove();
            $.each(data.user,function(index,obj){ //runnung loop to display each row in  table json
                //using data.user to parse json the iterate throughh each element
                flag=obj.created_at; //assigning the flag to manage td and its total
                flagfornodata = obj.name;
                if(obj.created_at){ //cheacking if timestamp has fetched from DB
                  $("#th_2").show();
                  $("#th_3").show();
                  d = obj.created_at.split(' ')[0]; //seetting the varibale and remove time form timestamp
                }
                if(!obj.created_at){
                    $("#th_2").hide(); //hide date head if date is not recieved i.e for summary only 
                    $("#th_3").hide();
                }
                var tr = $("<tr></tr>");
                tr.append("<td>"+ obj.name +"</td>"); //appending all data to td tag
                if(obj.created_at){ //display to all other than summary request  
                  tr.append("<td>"+ moment(d, "YYYY-MM-DD ").format("MMMM D, YYYY") +"</td>");
                  tr.append("<td>"+ obj.price +"</td>");
                }
                
                tr.append("<td>"+ obj.quantity +"</td>");
                tr.append("<td>"+ obj.total +"</td>");
                //tr.append("<td>"+ (obj.quantity * price) +"</td>"); //appending individual total
                counter =counter + parseInt(obj.total); //converting obj to int and addinf total for each quantity
                $("#mydata").append(tr); //append by id
            });

           
           var tr2 = $("<tr id='myid'></tr>"); //making new variable for appending last i.e total row
           tr2.append("<td></td>");//appending empty entry
           if(flag || !flagfornodata){ //not adding only if summary request has set and should add if no record has found
            tr2.append("<td></td>");
            tr2.append("<td></td>");
           }     //appending empty entry
           tr2.append("<td>GRAND TOTAL</td>"); //adding dummy row
           tr2.append("<td>"+ counter +" Rs.</td>"); //Add produdct price manually and multiply with total 
           $("#mydata").append(tr2); //appending new row
        }, 
       
        error: function(data) {
           alert('Something went wrong');
       }
   });  
}
$('input[name="daterange"]').change(change); //calling ajax call when date changes
$('.dropdown li').click(change); //calling ajax when li is clicked
// $('.dropdown-menu li').click(change); //calling ajax when li is clicked
//});

</script>

