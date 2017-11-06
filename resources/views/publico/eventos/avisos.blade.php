@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <h1>{{ $evento->nome }}</h1>
    @if (!Auth::guest())
        @if(!$evento->isParticipante(Auth::user()->id))
            {{ Form::open(['url' => route('eventosPublico::participar', ['nomeSlug' => $evento->nomeSlug]),
                'method' => 'POST', 'class' => 'pull-right']) }}
            <button class="button button-green" type="submit" role="button">
                <i class="fa fa-plus" aria-hidden=""></i> Participar
            </button>
            {{ Form::close() }}
        @endif
    @endif
    <h2>Avisos</h2>
    <hr/>
    <div class="col-sm-8 blog-main">
        @forelse($noticias as $noticia)
            <div class="blog-post">
                <h2 class="blog-post-title" id="Noticia{{ $noticia->id }}">{{ $noticia->titulo }}</h2>
                <p class="blog-post-meta text-capitalize">
                    {{ $noticia->dataHoraPublicacao->formatLocalized('%B %e, %G') }}
                    <a href="#Noticia{{ $noticia->id }}">{{ $noticia->editor->nome }} </a>
                </p>
                <p class="blog-new"> {!!  nl2br($noticia->preview)  !!}<a class="see-more">... Leia mais</a></p>
                <p class="blog-new-content"> {!! nl2br($noticia->noticia)  !!}<a class="see-less"> Veja menos</a>
                </p>
            </div>
            <hr/>
        @empty
            <p class="paragrafo">Não há avisos</p>
        @endforelse
        {{ $noticias->links() }}
    </div>
    <script type="application/javascript">
        $(".blog-new-content").each(function () {
            $(this).hide();
        });
        $(".see-more").click(function () {
            $(this).parent('.blog-new').next('.blog-new-content').show();
            $(this).parent('.blog-new').hide();
        });
        $(".see-less").click(function () {
            $(this).parent('.blog-new-content').prev('.blog-new').show();
            $(this).parent('.blog-new-content').hide();
        });
    </script>
@endsection
