function montarAirbus(contenedor)
{
    $('#airbusines').remove();
    $('#airresto').remove();
    $('#boinbusines').remove();
    $('#boinresto').remove();
    
    tabla1= $('<table>').attr({'id':'airbusines'}).css({top:'232px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
    tbody1=$('<tbody>');
    thead1=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text(' ').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

   for (let i = 1; i<=4;i++)
   {
       var fila =$('<tr>')
       $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                       .hover(function(){
                       $(this).css("opacity", 0.3);
                       }, function(){
                        $(this).css("opacity", 1);
           })).appendTo(fila);

       $('<td>').text(i+" ").appendTo(fila);

       $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-E'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                        .hover(function(){
                       $(this).css("opacity", 0.3);
                       }, function(){
                       $(this).css("opacity", 1)})).appendTo(fila);
       $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-F'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                       .hover(function(){
                       $(this).css("opacity", 0.3);
                       }, function(){
                       $(this).css("opacity", 1)})).appendTo(fila);
       tbody1.append(fila);
   }
  tabla1.append(thead1);
  tabla1.append(tbody1);
  contenedor.append(tabla1);

   tabla2 = $('<table>').attr({'id':'airresto'}).css({top:'357px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
   tbody2=$('<tbody>');
   thead2=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text(' ')).append($('<th>').text('C').addClass("text-center")).append($('<th>').text('D').addClass("text-center"));

   for (let i = 5; i<=20;i++)
   {
       if (i >= 5 && i<10)
       {
           var fila =$('<tr>')
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-B'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').text(i+" ").appendTo(fila)
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-C'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-D'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
       }
       else
       {
           var fila =$('<tr>')
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-B'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').text(i+" ").appendTo(fila)
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-C'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
           $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-D'}).css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
               $(this).css("opacity", 0.3);
               }, function(){
               $(this).css("opacity", 1)})).appendTo(fila);
       }
      
       tbody2.append(fila);
   }
  tabla2.append(thead2);
  tabla2.append(tbody2);
  contenedor.append(tabla2);
}

function montarBoeing(contenedor)
{
    $('#boinbusines').remove();
    $('#boinresto').remove();
        $('#airbusines').remove();
        $('#airresto').remove();

         tabla1 = $('<table>').attr({'id':'boinbusines'}).css({top:'232px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
         tbody1=$('<tbody>');
         thead1=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text(' ').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 1; i<=3;i++)
        {
            var fila =$('<tr>')
            $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                             $(this).css("opacity", 1);
                })).appendTo(fila);
            $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-B'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                .hover(function(){
                $(this).css("opacity", 0.3);
                }, function(){
                 $(this).css("opacity", 1);
            })).appendTo(fila);

            $('<td>').text(i+" ").appendTo(fila);

            $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-E'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                             .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-F'}).css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            tbody1.append(fila);
        }
       tabla1.append(thead1);
       tabla1.append(tbody1);
       contenedor.append(tabla1);

        tabla2 = $('<table>').attr({'id':'boinresto'}).css({top:'357px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
        tbody2=$('<tbody>');
        thead2=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text('C').addClass("text-center")).append($('<th>').text(' ')).append($('<th>').text('D').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 5; i<=20;i++)
        {
            if (i >= 5 && i<10)
            {
                var fila =$('<tr>')
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-B'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-C'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-D'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-E'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-F'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
            }
            else
            {
                var fila =$('<tr>')
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-A'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-B'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-C'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-D'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-E'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').addClass('asiento').append($('<div>').attr({'id':i+'-F'}).css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
           
            tbody2.append(fila);
        }
       tabla2.append(thead2);
       tabla2.append(tbody2);
       contenedor.append(tabla2);
}

function asignarAsientos(idvuelo)
{
    $.getJSON("/apiasiento/dameasientos/"+idvuelo, function(asientos) {    
        var elem= $('.asiento');
        for(var i=0;i<elem.length;i++)
        {
           elem[i].id=asientos['data'][i]['id']+'-'+asientos['data'][i]['fila']+'-'+asientos['data'][i]['columna'];
           if(asientos['data'][i]['ocupado']==true || asientos['data'][i]['clase']=='Business')
            {
                elem[i].className='';
                $('#'+asientos['data'][i]['fila']+'-'+asientos['data'][i]['columna']).css('background-color', 'red').off('mouseenter mouseleave');
            }
        }  

        $('.asiento').dblclick(function() 
        {

            var id = $(this).attr('id');
           
            const partes = id.split("-");
                const variable1 = partes[0];
                const variable2 = partes[1];
                const variable3 = partes[2];

            if (asientoidaconfirmado == false)
            {
                AsientoIda=variable1;
                $('#asientoida').attr('id',variable1);
                $('#columnaida').text(variable3);
                $('#filaida').text(variable2);
                $('.btnVuelta').attr('id',id+"-regular").fadeIn();
            }
            else if (asientoidaconfirmado == true)
            {
                AsientoVuelta=variable1;
                $('#asientoida').attr('id',variable1);
                $('#columnaida').text(variable3);
                $('#filaida').text(variable2);
                $('#btncontinuarvuelta').fadeIn();
            }
            

            
        });
    });  
   
}

function asignarAsientosBusiness(idvuelo)
{
    $.getJSON("/apiasiento/dameasientos/"+idvuelo, function(asientos) {    
        var elem= $('.asiento');
        for(var i=0;i<elem.length;i++)
        {
           elem[i].id=asientos['data'][i]['id']+'-'+asientos['data'][i]['fila']+'-'+asientos['data'][i]['columna'];
           if(asientos['data'][i]['ocupado']==true)
            {
                elem[i].className='';
                $('#'+asientos['data'][i]['fila']+'-'+asientos['data'][i]['columna']).css('background-color', 'red').off('mouseenter mouseleave');
            }
        } 


        
        $('.asiento').dblclick(function() 
        {
            
            var id = $(this).attr('id');
            const partes = id.split("-");
                const variable1 = partes[0];
                const variable2 = partes[1];
                const variable3 = partes[2];
               
                if (asientoidaconfirmado == false)
                {
                    AsientoIda=variable1;
                    $('#asientoida').attr('id',variable1);
                    $('#columnaida').text(variable3);
                    $('#filaida').text(variable2);
                    $('.btnVuelta').attr('id',id+"-regular").fadeIn();
                }
                else if (asientoidaconfirmado == true)
                {
                    AsientoVuelta=variable1;
                    $('#asientoida').attr('id',variable1);
                    $('#columnaida').text(variable3);
                    $('#filaida').text(variable2);
                    $('#btncontinuarvuelta').fadeIn();
                }
              
        });
    });  
   
}