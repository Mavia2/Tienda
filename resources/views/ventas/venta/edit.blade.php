@extends ('layouts.admin')
@section ('titulo')  Nueva Venta
@endsection
@section ('contenido')
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
    </div>
    @endif
  </div>
</div>
<div class="row">
  
 {!!Form::model($venta,['method'=>'PATCH','route'=>['venta.update', $venta->idventa]])!!}
  {{Form::token()}}
  <div class="col-lg-2 col-md-5 col-xs-12">
    <label>Cliente</label>
    <div class="form-group form-inline">   
      <select id="idpersona" name="idpersona" class="form-control selectpicker form-inline" data-live-search="true">                       
        @foreach($personas as $per)
          @if($per->idpersona==$venta->idpersona)
          <option value="{{$per->idpersona}}" selected>{{$per->usuario}} </option>
          @else
          <option value="{{$per->idpersona}}">{{$per->usuario}} </option>
          @endif
        @endforeach
      </select>
                       
    </div>
  </div>

<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">
       <label>Fecha Venta</label>       
       <input  id="fecha" name="fecha" class="form-control" value="@php $f=new Carbon\Carbon();$fv=$f->createFromFormat('Y-m-d',$venta->fecha); @endphp{{$fv->format('d/m/Y')}}">
    </div>
</div> 

<div class="col-lg-2 col-md-5 col-xs-12">
    <label>Tipo de venta</label>
    <div class="form-group form-inline">   
      <select id="tventa" name="tventa" class="form-control selectpicker form-inline" data-live-search="true">                       
        @foreach($ped2 as $key=>$value)
          @if($key==$venta->id_pedidos)
          <option value="{{$key}}" selected>{{$value}} </option>
          @else
          <option value="{{$key}}">{{$value}} </option>
          @endif
        @endforeach
      </select>
                       
    </div>
  </div>

<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">      
      <label>Estado Venta</label>
      <select type="text" id="estado" name="estado"class="form-control" value="{{$venta->vestado}}">
        @if($venta->vestado=="Confirmada")
        <option value="Confirmada" selected>1 - Confirmada</option>
        <option value="Contactada">2 - Contactada </option>
        <option value="Entregada">3 - Entregada </option>
        @elseif($venta->vestado=="Contactada")
        <option value="Confirmada">1 - Confirmada</option>
        <option value="Contactada" selected>2 - Contactada </option>
        <option value="Entregada">3 - Entregada </option>
        @else
        <option value="Confirmada">1 - Confirmada</option>
        <option value="Contactada">2 - Contactada </option>
        <option value="Entregada" selected>3 - Entregada </option> 
        @endif   
      </select>     
    </div>
</div> 
    <div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">
       <label>Comentarios</label>       
       <input  name="vcomentario" id="vcomentario" class="form-control" value="{{$venta->vcomentario}}">
    </div>
    </div> 


    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group text-center" style="margin-top:25px"> 
         <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>      
        <button class="btn btn-primary" type="submit" style="margin-left:5px">Guardar</button>
       
      </div>
       {!!Form::close()!!}
    </div>
  
   

</div> 

  
   <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      Detalle de Ventas
      <table class="table table-striped table-bordered table-condensed table-hover" style="text-align: center">
        <thead style="background-color:#A9D0F5">
          
          <th style="text-align: center">Id stock</th>
          <th style="text-align: center">Codebar</th>
          <th style="text-align: center">imagen</th>
          <th style="text-align: center">Producto</th>
          <th style="text-align: center">Style</th>
          <th style="text-align: center">talle</th>
          <th style="text-align: center">Orden</th>
          <th style="text-align: center">Precio</th>
          <th style="text-align: center">Opciones</th>
          
        </thead>
       
        
     
            @php $nx=0;@endphp
            @foreach($detaven as $w)                
                <tr>
                  <td>{{$w->idstock}}</td>  
                  <td>{{$w->codebar}}</td>                                 
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModalll{{$nx}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModalll{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>                  
                  <td style="text-align: center">{{$w->orden}}</td>
                  <td style="text-align: center">$ {{number_format($w->precio_venta,0)}}</td>
                  <td>
                     {!!Form::model(Request::all(),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleventa.destroy', $w->iddetalleventa, $w->idstock]])!!}
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                     {!!Form::close()!!}
                  </td>               
                  
                </tr>
                @endforeach
                 </table>
              </div> 
            </div> 
    
<div class="row">
       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        {!! Form::model(Request::all(), ['action'=>['DetalleventaController@store', $id],'method'=>'STORE','class'=>'form-inline'])!!}
                  <div id="idpersona3"><input type="hidden" id="idpersona" class="form-control" name="idpersona" value="1"></div>
                  <div id="fecha3"><input type="hidden" id="fecha" class="form-control" name="fecha" ></div>
                  <div id="estado3"><input type="hidden" id="estado" class="form-control" name="estado" ></div>
                  <div id="tventa3"><input type="hidden" id="tventa" class="form-control" name="tventa" ></div>
                  <div id="vcomentario3"><input type="hidden" id="vcomentario" class="form-control" name="vcomentario" ></div>
      <table class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#F9D0F5">
                
                <th style="text-align: center">idStock</th>
                <th style="text-align: center">Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th style="text-align: center">Producto</th>
                <th style="text-align: center">Style</th>
                <th style="text-align: center">Talle</th> 
                <!--<th style="text-align: center"> Tipo Venta</th>-->       
                <th style="text-align: center"> Precio</th>                  
                <th style="text-align: center"> Opciones</th>            
              </thead>
              
              <tbody style="text-align: center">
                @php $nn=0;@endphp
                @foreach($articulos as $w)
                
                <tr>
                   
                   <td><input type="hidden" value="{{$w->idstock}}" name="idstock">{{$w->idstock}}</td>
                   <td><input type="hidden" value="{{$id}}" name="idventa">{{$w->codebar}}</td>

                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModall{{$nn}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModall{{$nn}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nn++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                 
                  <td style="text-align: center"><input name="precio" id="precio" type="number" required value="{{$w->precio_v}}"></input></td>                                                     
                  <td style="text-align: center"> 
                    
                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                   
                  </td>
                   
                </tr>
                @endforeach
              </tbody>
            </table>
             {!!Form::close()!!}
          </div>
         </div> 

<div class="box">
 <div class="box-header with-border">
   <h3 class="box-title">Buscar Productos</h3>
    <div class="box-tools pull-right">
     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
 
  <!-- /.box-header -->
 <div class="box-body">
   <div class="row">
     <div class="col-lg-3 col-md-4 col-xs-12">

       {!! Form::model(Request::only('type','searchText','talle','prod','ped','venta'), ['route'=>['venta.edit', $id],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
      <div id="idpersona2" ><input type="hidden" id="idpersona" class="form-control" name="idpersona" value="1"></div>
      <div id="fecha2" ><input type="hidden" id="fecha" class="form-control" name="fecha" ></div>
      <div id="estado2" ><input type="hidden" id="estado" class="form-control" name="estado" ></div>
      <div id="tventa2" ><input type="hidden" id="tventa" class="form-control" name="tventa" ></div>
      <div id="vcomentario2" ><input type="hidden" id="vcomentario" class="form-control" name="vcomentario" ></div>
      <div class="form-group">
        <label>Codigo de barra o Style</label> 
        <div class="input-group">
          <input type="text" id="searchText" class="form-control" name="searchText" placeholder="Codigo de barra..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        </div>
      </div>
      </div>
      <div class="col-lg-2 col-md-4 col-xs-12">
        </div>
     <div class="col-lg-2 col-md-2 col-xs-12 ">
      <div class="form-group  pull-right"> 
      <label>Producto</label>     
       {!! Form::select('prod',$prod1,null,['class'=>'form-control','id'=>'prod'])!!}
               
      </div>
     </div>

  <div class="col-lg-2 col-md-2 col-xs-12 ">
    <div class="form-group  pull-right"> 
    <label>Talle</label>     
    {!! Form::select('talle',$talle2,null,['class'=>'form-control','id'=>'talle', 'data-live-search'=>'true'])!!}
                
  </div>
  </div>
  
  <div class="col-lg-3 col-md-2 col-xs-12 "> 
   <div class="form-group  pull-right"> 
  <label>Orden</label>       
    <div class="form-group form-inline"> 
      {!! Form::select('type',$orden2,null,['class'=>'form-control','id'=>'type'])!!}
      <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
  </div>
  </div>    
 
</div>
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
       Cant: {{$busca->count()}}
      <table class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                <th>idStock</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th>Style</th>
                <th style="text-align: center">Talle</th>                                
                <th>Orden</th>
                <th style="text-align: center">Pedido</th>
                <th>estado</th>                
                <th style="text-align: center"> Opciones</th>              
              </thead>
              
              <tbody id="todo">
                @php $n=0;@endphp
                @foreach($busca as $w)
                
                <tr>
                   <td>{{$w->idstock}}</td>
                   <td>{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$n}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$n}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $n++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->orden}}</td>                                 
                  <td>{{$w->nombre}}</td>
                  <td>{{$w->estado}}</td>                                      
                  <td style="text-align: center"> <button type="submit" id="venta" name="venta" class="btn btn-primary btn-sm" value="{{$w->idstock}}">Seleccionar</button></td>
                </tr>
                @endforeach
                 {!!Form::close()!!}
              </tbody>
            </table>            
          </div>
    </div>
   </div><!-- /.box-body -->
</div><!-- /.box -->

@push('script')
  <script>
  $(document).ready(function(){
     setInterval(function() {
     idp =$('#idpersona').val();
     fech =$('#fecha').val();
     est =$('#estado').val();
     tven =$('#tventa').val();
     vc =$('#vcomentario').val();
     $('#idpersona2').html("<input type='hidden' id='idpersona' class='form-control' name='idpersona' value='"+idp+"'>");
     $('#fecha2').html("<input type='hidden' id='fecha' class='form-control' name='fecha' value='"+fech+"'>");
     $('#estado2').html("<input type='hidden' id='estado' class='form-control' name='estado' value='"+est+"'>");
     $('#tventa2').html("<input type='hidden' id='tventa' class='form-control' name='tventa' value='"+tven+"'>");
     $('#vcomentario2').html("<input type='hidden' id='vcomentario' class='form-control' name='vcomentario' value='"+vc+"'>");

     $('#idpersona3').html("<input type='hidden' id='idpersona' name='idpersona' value='"+idp+"'>");
     $('#fecha3').html("<input type='hidden' id='fecha' name='fecha' value='"+fech+"'>")
     $('#estado3').html("<input type='hidden' id='estado' name='estado' value='"+est+"'>")
     $('#tventa3').html("<input type='hidden' id='tventa' name='tventa' value='"+tven+"'>")
     $('#vcomentario3').html("<input type='hidden' id='vcomentario' name='vcomentario' value='"+vc+"'>")
      }, 1000);
     
    

  }); 
</script>
@endpush
   
  <!--@push('script')
  <script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

  var cont=0;
  total=0;
  subtotal=[];
  $('#guardar').hide();

  function agregar(){
    idproducto=$('#pidproducto').val();
    producto=$('#pidproducto option:selected').text();
    precio=$('#pprecio').val();

    if (idproducto!=""&& precio!=""){
      subtotal[cont]=(precio);
      total=total+subtotal[cont];

      var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td></td><td></td><td><input type="hidden" name"idproducto[]" value="'+idproducto+'">'+producto+'</td><td></td><td><input type="number" name"precio[]" value="'+precio+'"></td>'+subtotal[cont]+'<td></td></tr>';
      cont++;
      limpiar();
      $('#total').html("US$"+total);
      evaluar();
      $('#detalles').append(fila);
    }
    else{
      alert("error ingresar precio y articulo");
    }

  }

  function limpiar(){
    $("#pprecio").val("");
  }
  function evaluar(){
    if (total>0){
      $("#guardar").show();
    }
    else{
      $("#guardar").hide();
    }
  }
  function eliminar(index){
    total=total-subtotal[index];
    $('#total').html("US$"+total);
    $("#fila"+index).remove();
    evaluar();
  }
  </script>
  @endpush -->
@endsection
