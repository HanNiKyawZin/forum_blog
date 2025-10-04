@foreach($replies->sortBy('created_at') as $reply)
    <div class="border-start ps-3 mb-2">
        <strong>{{ $reply->guest_name }}</strong>: {{ $reply->content }}

        <!-- Delete Button for Reply -->
        <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="d-inline ms-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this reply?')">Delete</button>
        </form>

        <!-- Reply to Reply (Optional) -->
        <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $reply->id }}">
            Reply
        </button>

        <div class="collapse mt-2" id="replyForm{{ $reply->id }}">
            <form action="{{ route('admin.comments.reply', $reply->id) }}" method="POST">
                @csrf
                <textarea name="content" class="form-control mb-2" rows="2" placeholder="Write a reply..." required></textarea>
                <button type="submit" class="btn btn-sm btn-success">Submit Reply</button>
            </form>
        </div>

        <!-- Recursive nested replies -->
        @if($reply->replies->count())
            <div class="ms-4 mt-2">
                @include('admin.comments.partials.replies', ['replies' => $reply->replies])
            </div>
        @endif
    </div>
@endforeach
