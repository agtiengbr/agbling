{if $authenticated}
    <div class="alert alert-success">O aplicativo da AGTI está configurado para manipular a sua conta Bling corretamente.</div>
{else}
    <div class="alert alert-danger">Para o correto funcionamento do módulo, você precisa autorizar o aplicativo da AGTI a manipular a sua conta Bling. Para isso, <a href='{$auth_url}' target='_blank'>clique aqui</a>.</div>
{/if}