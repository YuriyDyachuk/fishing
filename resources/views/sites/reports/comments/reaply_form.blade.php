<form method="post" action="{{ route('customer.comment.reply') }}" id="replyForm" class="">
    @csrf
    <div class="form-group">
            <textarea class="form-control"
                      name="comment"
                      id="form6Example7"
                      required
                      rows="4">{{ $comment->body }}</textarea>
        <input type="hidden" name="reportId" value="{{ $reportId }}" />
        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
    </div>
    &nbsp;
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-right" value="Ответить" />
    </div>
</form>