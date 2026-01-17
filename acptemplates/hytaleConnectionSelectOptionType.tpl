{if $hytaleList|count}
    <select id="{$option->optionName}" name="values[{$option->optionName}]">
        <option></option>
        {foreach from=$hytaleList item=hytale}
            <option value="{@$hytale->getObjectID()}" {if $hytale->getObjectID() == $value} selected{/if}>
                {$hytale->getTitle()}</option>
        {/foreach}
    </select>
{else}
    <p class="info">{lang}wcf.acp.hytaleSelectOptionType.noServer{/lang}</p>
{/if}