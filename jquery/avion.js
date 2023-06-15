$(function(){
     var tabla1="";
     var tbody1;
     var thead1;
     var tabla2="";
     var tbody2;
     var thead2;
     $("#contavion").css('background-image', 'url("../assets/imgs/airbus.png")');
     tabla1= $('<table>').attr({'id':'airbusines'}).css({top:'232px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
         tbody1=$('<tbody>');
         thead1=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text(' ').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 1; i<=4;i++)
        {
            var fila =$('<tr>')
            $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                             $(this).css("opacity", 1);
                })).appendTo(fila);

            $('<td>').text(i+" ").appendTo(fila);

            $('<td>').attr({'id':i+'-E'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                             .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            $('<td>').attr({'id':i+'-F'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            tbody1.append(fila);
        }
       tabla1.append(thead1);
       tabla1.append(tbody1);
       $("#contavion").append(tabla1);

        tabla2 = $('<table>').attr({'id':'airresto'}).css({top:'357px',left:'176px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
        tbody2=$('<tbody>');
        thead2=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text(' ')).append($('<th>').text('C').addClass("text-center")).append($('<th>').text('D').addClass("text-center"));

        for (let i = 5; i<=20;i++)
        {
            if (i >= 5 && i<10)
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
            else
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
           
            tbody2.append(fila);
        }
       tabla2.append(thead2);
       tabla2.append(tbody2);
       $("#contavion").append(tabla2);
    $( "#airbus" ).checkboxradio().on("change", function(event){
        $("#contavion").css('background-image', 'url("../assets/imgs/airbus.png")');
        $('#boinbusines').remove();
        $('#boinresto').remove();
        tabla1= $('<table>').attr({'id':'airbusines'}).css({top:'215px',left:'90px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
         tbody1=$('<tbody>');
         thead1=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text(' ').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 1; i<=4;i++)
        {
            var fila =$('<tr>')
            $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                             $(this).css("opacity", 1);
                })).appendTo(fila);

            $('<td>').text(i+" ").appendTo(fila);

            $('<td>').attr({'id':i+'-E'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                             .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            $('<td>').attr({'id':i+'-F'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            tbody1.append(fila);
        }
       tabla1.append(thead1);
       tabla1.append(tbody1);
       $("#contavion").append(tabla1);

        tabla2 = $('<table>').attr({'id':'airresto'}).css({top:'340px',left:'90px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
        tbody2=$('<tbody>');
        thead2=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text(' ')).append($('<th>').text('C').addClass("text-center")).append($('<th>').text('D').addClass("text-center"));

        for (let i = 5; i<=20;i++)
        {
            if (i >= 5 && i<10)
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
            else
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'30px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
           
            tbody2.append(fila);
        }
       tabla2.append(thead2);
       tabla2.append(tbody2);
       $("#contavion").append(tabla2);
    });




    $( "#boeing" ).checkboxradio().on("change", function(event){
        $("#contavion").css('background-image', 'url("../assets/imgs/boeing.png")');
        $('#airbusines').remove();
        $('#airresto').remove();
         tabla1 = $('<table>').attr({'id':'boinbusines'}).css({top:'227px',left:'80px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
         tbody1=$('<tbody>');
         thead1=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text(' ').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 1; i<=3;i++)
        {
            var fila =$('<tr>')
            $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                             $(this).css("opacity", 1);
                })).appendTo(fila);
            $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                .hover(function(){
                $(this).css("opacity", 0.3);
                }, function(){
                 $(this).css("opacity", 1);
            })).appendTo(fila);

            $('<td>').text(i+" ").appendTo(fila);

            $('<td>').attr({'id':i+'-E'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                             .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            $('<td>').attr({'id':i+'-F'}).addClass('asiento').append($('<div>').css({width:'30px',height:'20px',border:'1px solid black','border-radius':'5px','backgroundColor':'#fad02d'})
                            .hover(function(){
                            $(this).css("opacity", 0.3);
                            }, function(){
                            $(this).css("opacity", 1)})).appendTo(fila);
            tbody1.append(fila);
        }
       tabla1.append(thead1);
       tabla1.append(tbody1);
       $("#contavion").append(tabla1);

        tabla2 = $('<table>').attr({'id':'boinresto'}).css({top:'330px',left:'80px',width:'150px',heigth:'70px',position:'absolute','z-index':1});
        tbody2=$('<tbody>');
        thead2=$('<thead>').append($('<th>').text('A').addClass("text-center")).append($('<th>').text('B').addClass("text-center")).append($('<th>').text('C').addClass("text-center")).append($('<th>').text(' ')).append($('<th>').text('D').addClass("text-center")).append($('<th>').text('E').addClass("text-center")).append($('<th>').text('F').addClass("text-center"));

        for (let i = 5; i<=20;i++)
        {
            if (i >= 5 && i<10)
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-E'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-F'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#bc7a5c'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
            }
            else
            {
                var fila =$('<tr>')
                $('<td>').attr({'id':i+'-A'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-B'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-C'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                        $(this).css("opacity", 0.3);
                        }, function(){
                        $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').text(i+" ").appendTo(fila)
                $('<td>').attr({'id':i+'-D'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-E'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
                $('<td>').attr({'id':i+'-F'}).addClass('asiento').append($('<div>').css({width:'20px',height:'15px',border:'1px solid black','border-radius':'5px','backgroundColor':'#3f4e9b'}).hover(function(){
                    $(this).css("opacity", 0.3);
                    }, function(){
                    $(this).css("opacity", 1)})).appendTo(fila);
            }
           
            tbody2.append(fila);
        }
       tabla2.append(thead2);
       tabla2.append(tbody2);
       $("#contavion").append(tabla2);
    });
})