<div class="modal fade modal-slide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$per->idpersona}}">
  {{Form::open(['action'=>array('ClienteController@destroy',$per->idpersona),'method'=>'delete'])}}
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#F4364C">
          <button type="button" class="close" data-dismiss="modal" aria-lavel="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title" style="text-align: center">Eliminar Cliente</h4>
        </div>
        <div class="modal-body">
          Esta seguro que desea eliminar al Cliente: <b>{{$per->usuario}}</b>
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           

        </div>
      </div>
  {{Form::Close()}}
</div>
</div>
