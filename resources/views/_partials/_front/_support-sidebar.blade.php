
<div class="support-sidebar">
    <div class="support-sidebar__name">Supporto</div>
    <ul class="support-sidebar__links">
        <li>
            <a href="{{route("pages-terms")}}" class="{{Route::current()->getName()=="pages-terms"?'is-active':''}}">Termini e condizioni</a>
        </li>
        <li>
            <a href="{{route("pages-privacy")}}" class="{{Route::current()->getName()=="pages-privacy"?'is-active':''}}">Privacy policy</a>
        </li>
        <li>
            <a href="/faqs">FAQs</a>
        </li>
    </ul>
</div>