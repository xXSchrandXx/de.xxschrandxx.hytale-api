{include file='header' pageTitle='wcf.acp.menu.link.configuration.hytale.hytaleList.'|concat:$action}

<header class="contentHeader">
    <div class="contentHeaderTitle">
        <h1 class="contentTitle">{lang}wcf.acp.menu.link.configuration.hytale.hytaleList.{$action}{/lang}</h1>
    </div>

    <nav class="contentHeaderNavigation">
        <ul>
            <li>
				<a href="{link controller='HytaleList'}{/link}" class="button">
					{icon size=16 name='list' type='solid'}
                	<span>{lang}wcf.acp.menu.link.configuration.hytale.hytaleList{/lang}</span>
				</a>
			</li>
            {event name='contentHeaderNavigation'}
        </ul>
    </nav>
</header>

{@$form->getHtml()}

{include file='footer'}