$(function(){
    $( "#ida" ).checkboxradio();
    $( "#idavuelta" ).checkboxradio();

    $( "#idavuelta" ).change(function() {
        if ($(this).is(":checked")) {
          $( "#datepickervuelta" ).fadeIn();
          $( "#labeldatepickervuelta" ).fadeIn();
        } else {
          $( "#datepickervuelta" ).fadeOut();
          $( "#labeldatepickervuelta" ).fadeOut();
        }
      });
    
      $( "#ida" ).change(function() {
        if ($(this).is(":checked")) {
          $( "#datepickervuelta" ).fadeOut();
          $( "#labeldatepickervuelta" ).fadeOut();
        }
      });

    $( "#origen" ).selectmenu({width:'450px'},{height:'200px'},{select: function( event, ui ) {
       
        var select=$( "#destino" ).selectmenu(['select#destino']);
        var options=select['0']['children'];

        for(let i = 0 ; i < options.length;i++)
        {
            $("#destino option[value='" + i + "']").attr("disabled",null);
            $( "#destino" ).selectmenu("refresh");
        }

        for(let i = 0 ; i < options.length;i++)
        {
           if ( options[i]['label'] == $('.ui-selectmenu-text')[0]['innerHTML'])
           {
            $("#destino option[value='" + i + "']").attr("disabled","disabled");
            $( "#destino" ).selectmenu("refresh");
           }
        }  

       }});


    $( "#destino" ).selectmenu({width:'450px'},{height:'200px'},{select: function( event, ui ) {

        var select=$( "#origen" ).selectmenu(['select#origen']);

        var options=select['0']['children'];
        console.log(options.length);


        for(let i = 0 ; i < options.length;i++)
        {
            $("#origen option[value='" + i + "']").attr("disabled",null);
            $( "#origen" ).selectmenu("refresh");
        }

        for(let i = 0 ; i < options.length;i++)
        {
           if ( options[i]['label'] == $('.ui-selectmenu-text')[1]['innerHTML'])
           {
            $("#origen option[value='" + i + "']").attr("disabled","disabled");
            $( "#origen" ).selectmenu("refresh");
           }
        }
        console.log($('.ui-selectmenu-text')[1]['innerHTML']);
    }});
 
    $('#origen-button').addClass('fz-30');
    $('#destino-button').addClass('fz-30');
    var array = ["2023-03-14","2023-03-15","2023-03-16"]
    var RangeDatesIsDisable = true;
    $( "#datepickerida" ).css({width:'250px'},{height:'50px'}).datepicker({

        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ array.indexOf(string) == -1 ]
        }
    });

var RangeDates=["14/3/2023, 16/3/2023,19/3/2023"];var RangeDatesIsDisable=true;
function DisableDays(date){var isd=RangeDatesIsDisable;var rd=RangeDates;var m=date.getMonth();var d=date.getDate();var y=date.getFullYear();for(i=0;i<rd.length;i++){var ds=rd[i].split(",");var di,df;var m1,d1,y1,m2,d2,y2;if(ds.length==1){di=ds[0].split("/");m1=parseInt(di[0]);d1=parseInt(di[1]);y1=parseInt(di[2]);if(y1==y&&m1==m+1&&d1==d)return[!isd]}else if(ds.length>1){di=ds[0].split("/");df=ds[1].split("/");m1=parseInt(di[0]);d1=parseInt(di[1]);y1=parseInt(di[2]);m2=parseInt(df[0]);d2=parseInt(df[1]);y2=parseInt(df[2]);if(y1>=y||y<=y2)if(m+1>=m1&&m+1<=m2)if(m1==m2){if(d>=d1&&d<=d2)return[!isd]}else if(m1==m+1){if(d>=d1)return[!isd]}else if(m2==m+1){if(d<=d2)return[!isd]}else return[!isd]}}return[isd]};

    $( "#datepickervuelta" ).css({width:'250px'},{height:'50px'}).datepicker({
        maxDate: RangeDates.length,
        minDate: null,
        beforeShowDay: DisableDays
    });
});