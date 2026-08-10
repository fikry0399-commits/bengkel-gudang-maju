@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Category Management</h1>
          </div>
          <div class="row">
             
          </div>
        </section>
        <div class="section-body">
            <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#categoryModal">
                <i class="fas fa-plus"></i> Add
            </button>
            {{-- <div class="table table-responsive">
                <table class="table table-bordered table-responsive" id="categoryTable">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>category Name</th>
                            <th>Description</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div> --}}

        </div>
<!-- MODAL -->
 <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="categoryForm">
        @csrf
        <input type="hidden" name="id" id="category_id">
          <div class="modal-body">
            <div class="row">
                <div class="col">
                    <label for="category_name">Name</label>
                    <input type="text" class="form-control" id="category_name">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea class="summernote-simple" id="description"></textarea>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection