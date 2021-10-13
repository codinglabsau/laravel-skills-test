@if(!$posts->isEmpty())
    @foreach($posts as $key=>$value)
    <tr>
        <th scope="row">{{$key+1}}</th>
        <td>
            <img class="post-img" src="{{$value->imagefilepath}}" alt="{{$value->name}}">
        </td>
        <td>{{$value->name}}</td>
        <td>{!!$value->description!!}</td>
        <td class="action-td">
            <a href="{{ url('posts/edit/'.$value->post_id) }}" title="Edit" class="btn btn-sm btn-outline-primary">Edit</a>&nbsp;<a href="javascript:void(0);" onclick="deleteEntity({{ $value->post_id }});" title="Delete" class="btn btn-sm btn-danger">Delete</a>
        </td>
    </tr>
    @endforeach
@else
    <tr id="nodata">
        <td colspan="5" class="text-center">
            <h4 class="m-0">No post found!</h4>
        </td>
    </tr>
@endif