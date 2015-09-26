    <!-- TODO: change or remove custom style sheets
    Custom styles for this template 
    <link rel="stylesheet" href="<?php #echo base_url("assets/css/cover.css"); ?>" />
    -->
</head>

<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">
            FLATOUT
        </a>
        <img src="<?php echo base_url("assets/lizardDrinking.jpg"); ?>"
            class="img-rounded"
            alt="Lizard Drinking Logo"
            height="42" width="42"
            style="margin: 5px" >
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Tasks</a></li>
            <li><a href="#">People</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="<?php echo base_url($links['logoutLink']); ?>">Logout</a></li>
        </ul>
    </div>
</nav>

<h2>Add Tasks</h2>
<div class="col-lg-4">
    <!-- CodeIgniter Validation-->
    <?php echo validation_errors(); ?>
    <!-- open the form -->
    <?php echo form_open('tasks/addTask'); ?>
        <div class="input-group">
            <label for="inputDescription" class="sr-only">Add Task Description</label> 
            <input type="text" class="form-control" id="inputDescription" 
                    name="inputDescription" placeholder="Task Description" required='true'>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Add Task</button>
            </span>
        </div>
    </form>
</div>

<div class="col-lg-8">
    <nav class="navbar" role="task navigation">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">List 1</a></li>
            <li><a href="#">List 2</a></li>
        </ul>
    </nav>
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($tasks) {
                        foreach($tasks as $task) {
                            echo '<tr>';
                            echo '<td>' . $task->description . '</td>';
                            echo '<td>' . $task->status . '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    <div>
</div>
