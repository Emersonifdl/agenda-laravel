@extends('layout')

@section('main')
<div class="container-xl">
  @if ($errors->any())
  <div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  @endif
  <div class="table-responsive">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2>Manage <b>Contacts</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="#addContactModal" class="btn btn-success" data-toggle="modal">
              <i class="material-icons">&#xE147;</i>
              <span>Add New Contact</span>
            </a>
          </div>
        </div>
      </div>
      @if (count($contacts) > 0)
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>
              <span class="custom-checkbox">
                <input type="checkbox" id="selectAll">
                <label for="selectAll"></label>
              </span>
            </th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr>
            <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox5" name="options[]" value="1">
                <label for="checkbox5"></label>
              </span>
            </td>
            <td>{{$contact->name}}</td>
            <td>{{$contact->email}}</td>
            <td>
              <a href="#editContactModal{{$contact->id}}" class="edit" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
              </a>
              <a href="#deleteContactModal{{$contact->id}}" class="delete" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
              </a>
            </td>
          </tr>
          <!-- Delete Modal HTML -->
          <div id="deleteContactModal{{$contact->id}}" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <div class="modal-header">
                    <h4 class="modal-title">Delete Contact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {{$contact->name}}</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Edit Modal HTML -->
          <div id="editContactModal{{$contact->id}}" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="post" action="{{ route('contacts.update', $contact) }}">
                  @method('PUT')
                  @csrf
                  <div class="modal-header">
                    <h4 class="modal-title">Update Contact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>First Name</label>
                      <input name="first_name" type="text" class="form-control" required value="{{$contact->first_name}}">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input name="last_name" type="text" class="form-control" required value="{{$contact->last_name}}">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input name="email" type="email" class="form-control" required value="{{$contact->email}}">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Save">
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>

      <div class="clearfix">
        {{ $contacts->links() }}
      </div>
      @else
        <p> Not found records!</p>
      @endif

    </div>
  </div>
</div>
<!-- Add Modal HTML -->
<div id="addContactModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('contacts.store') }}">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Add Contact</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>First Name</label>
            <input name="first_name" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input name="last_name" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-success" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection