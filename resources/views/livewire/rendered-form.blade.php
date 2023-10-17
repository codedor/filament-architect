<div>
    @if ($formModel->allowSubmissions())
        @include('livewire-forms::form')
    @else
        {!! $formModel->getMaxSubmissionMessage() !!}
    @endif
</div>
