<div class="col-3 menu">
    <div class="row">
        <h2>Hello, {{Auth::user()->name}}</h2>
    </div>
    <hr>
    <div class="row">
        <a href="/seller/{{Auth::user()->id}}/statistic">
            <button class="menu-but">Statistic</button>
        </a>
        <a>
            <button class="menu-but">Add new</button>
        </a>
    </div>
</div>
