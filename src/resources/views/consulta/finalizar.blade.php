@extends('layouts.app')

@section('titulo', 'Editar a consulta')

@section('lateral')
@endsection

@section('conteudo')

    <p style="text-align:center">
        @if(session('msg'))
            <span class="texto-verde">
                {{ session('msg') }}
            </span>
        @endif

         @if(session('erro'))
            <span class="texto-vermelho">
                {{ session('erro') }}
            </span>
        @endif
    </p>

    <p>
        Edite esse consulta:
    </p>
    <br>

    <p><strong>Médica(o):</strong> {{ $consulta->usuario->nome }}</p>
    <p><strong>Horário definido:</strong> {{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }}</p>
    <p><strong>Paciente:</strong> {{ $consulta->paciente->usuario->nome }}</p>

    {{ Form::open(['url' => 'consultas/'.'/consulta/finalizar', 'method' => 'post']) }}

        <header>
            Por favor, veja os campos:
        </header>

        <section>
            <div>
                {{ Form::label('data', 'Data') }}
                {{ Form::date('data',
                    date('Y-m-d', strtotime($_GET['horario'])),
                    ['required' => '', 'readonly' => '']
                ) }}

                {{ Form::label('hor', 'Horário') }}
                <input type="time" name="hor" readonly required value="{{ date('H:i', strtotime($consulta->horario)) }}">

            </div>

            <div>
                {{ Form::label('valor', 'Preço') }}
                {{ Form::number('valor',
                    $consulta->valor,
                    ['step' => '0.10']
                ) }}

                {{ Form::label('status', 'Estado') }}
                {{ Form::select('status', [
                        'CONSULTA - Agendado' => 'CONSULTA - Agendado',
                        'CONSULTA - Confirmada' => 'CONSULTA - Confirmada',
                        'CONSULTA - Aguardando' => 'CONSULTA - Aguardando',
                        'RETORNO - Agendado' => 'RETORNO - Agendado',
                        'RETORNO - Confirmado' => 'RETORNO - Confirmado',
                        'RETORNO - Aguardando' => 'RETORNO - Aguardando'
                    ], $consulta->status,
                    ['required' => '']
                ) }}
            </div>

            <div>
                {{ Form::label('obs', 'Observação') }}
                {{ Form::textarea('obs', $consulta->obs,
                    ['placeholder' => 'Observação sobre a consulta']
                ) }}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar essa consulta" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {{ Form::close() }}

@endsection