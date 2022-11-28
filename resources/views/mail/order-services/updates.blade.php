@php(
    $defaultStyle = "box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';"
)

<div
    style="{{ $defaultStyle }};background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
           style="{{ $defaultStyle }}background-color:#edf2f7;margin:0;padding:0;width:100%">
        <tbody>
        <tr>
            <td align="center"
                style="{{ $defaultStyle }}">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                       style="{{ $defaultStyle }};margin:0;padding:0;width:100%">
                    <tbody>
                    <tr>
                        <td style="{{ $defaultStyle }};padding:25px 0;text-align:center">
                            <a href="http://localhost"
                               style="{{ $defaultStyle }};color:#3d4852;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block"
                               target="_blank">
                                {{ config('app.name', 'CD') }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" cellpadding="0" cellspacing="0"
                            style="{{ $defaultStyle }};background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation"
                                   style="{{ $defaultStyle }};background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px">
                                <tbody>
                                <tr>
                                    <td style="{{ $defaultStyle }};max-width:100vw;padding:32px">

                                        <h1 style="{{ $defaultStyle }};color:#3d4852;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                            Olá, {{ $user->name ?? '' }}!
                                        </h1>

                                        <p style="{{ $defaultStyle }};font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                            Uma O.S. foi aberta em seu nome na data: {{ $created_at }}
                                        </p>
                                        <p style="{{ $defaultStyle }};font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                            Para acessar, basta clicar no botão abaixo que será redirecionado.
                                        </p>
                                        <table align="center" width="100%" cellpadding="0" cellspacing="0"
                                               role="presentation"
                                               style="{{ $defaultStyle }};margin:30px auto;padding:0;text-align:center;width:100%">
                                            <tbody>
                                            <tr>
                                                <td align="center"
                                                    style="{{ $defaultStyle }}">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="{{ $defaultStyle }}">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center"
                                                                style="{{ $defaultStyle }}">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       role="presentation"
                                                                       style="{{ $defaultStyle }}">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="{{ $defaultStyle }}">
                                                                            <a href="{!! $link !!}"
                                                                               rel="noopener"
                                                                               style="{{ $defaultStyle }};border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748"
                                                                               target="_blank">
                                                                                Ordem de Serviço
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p style="{{ $defaultStyle }};font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                            Atenciosamente,<br>
                                            {{ config('app.name', 'CD') }}
                                        </p>


                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                               style="{{ $defaultStyle }};border-top:1px solid #e8e5ef;margin-top:25px;padding-top:25px">
                                            <tbody>
                                            <tr>
                                                <td style="{{ $defaultStyle }}">
                                                    <p style="{{ $defaultStyle }};line-height:1.5em;margin-top:0;text-align:left;font-size:14px">
                                                        Se você estiver com problemas para acessar através do botão acima, copie e cole essa URL abaixo no seu navegador:
                                                        <span style="{{ $defaultStyle }};word-break:break-all">
                                                            <a href="{!! $link !!}"
                                                                style="{{ $defaultStyle }};color:#3869d4"
                                                                target="_blank"
                                                            >
                                                                {!! $link !!}
                                                            </a>
                                                        </span>
                                                    </p>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="{{ $defaultStyle }}">
                            <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation"
                                   style="{{ $defaultStyle }};margin:0 auto;padding:0;text-align:center;width:570px">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="{{ $defaultStyle }};max-width:100vw;padding:32px">
                                        <p style="{{ $defaultStyle }};line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">
                                            © 2021 {{ config('app.name', 'CD') }}. Todos os direitos reservados.</p>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
