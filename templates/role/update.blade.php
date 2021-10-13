@extends('role/create')

<?php use ROH\Util\Inflector; ?>

@section('pagetitle')
    {{ f('pagetitle', l('Update {0}', Inflector::humanize(f('controller')->getClass()))) }}
@stop

@section('action-control')
<div class="card-footer d-flex bd-highlight">
    <div class="flex-grow-1 bd-highlight">
        <button type="button" class="btn btn-primary me-3" onclick="$('#createform').submit ()">
            <span class="indicator-label">Submit</span>
        </button>
        
        <a href="{{ f('controller.url') }}" type="button" class="btn btn-light">Cancel</a>
    </div>
    <div class="bd-highlight">
        <a href="javascript:;" class="btn btn-text-danger btn-active-light-danger form-delete" data-id="{{$entry['$id']}}" title="Delete">Delete</a>
    </div>
</div>
@stop

@section('customjs')
<script>
    $(document).ready(function() {
        $(document).on('click', '.form-delete', function() {

        var id = $(this).data('id');
        if(!id) return;

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure want to delete this data?",
            icon: "warning",
            showCancelButton: true,
        })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                $.ajax({
                    url: "{{f('controller.url')}}/"+id+"/delete.json",
                    type: "POST",
                }).done((response) => {
                    toastr.success('{{ l('{0}', Inflector::humanize(f('controller')->getClass())) }} deleted.', 'Success!');
                    setTimeout(() => {
                        window.location.href = "{{f('controller.url')}}"
                    }, 1000);
                }).catch(err => {
                    toastr.error('Error happened!', 'Error!');
                });
            }
        });
        });
    });
</script>
@stop