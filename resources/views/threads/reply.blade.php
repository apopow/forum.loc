<div id="reply-{{ $reply->id }}" class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a> написал {{ $reply->created_at->format('d-m-Y') }} в {{ $reply->created_at->format('H:i:s') }}
            </h5>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} 
                        <span class="glyphicon glyphicon glyphicon-star" style="color: #c9302c"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->body }}
    </div>

    @can ('update', $reply)
        <div class="panel-footer">
            <form method="POST" action="/replies/{{ $reply->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger btn-xs">Удалить</button>
            </form>
        </div>
    @endcan
</div>