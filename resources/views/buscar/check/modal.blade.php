<div class="modal fade"  role="dialog"  id="modal-delete-{{$bor->id}}">    
    <div class="modal-dialog modal-sm" >
      <div class="modal-content">
        <div class="modal-header" style="background-color:#F4364C">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Eliminar Producto <br> Codigo:{{$bor->code}} - Style:{{$bor->style}}</h4>
        </div>
        <div class="modal-body">
             <input type="hidden" class="form-control" name="id" value="{{$bor->id}}">
             <input type=hidden name="idfacebook" value="{{$bor->idfacebook}}">
             <div id="e{{$n}}"></div>             
           <img src="{{$bor->foto}}" width="260px" style="margin: auto">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="btn-delete" onclick="elim('{{$bor->id}}')">Eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>  
</div>
</div>
