<?php 
      if(!isset($_SESSION['logged_in'])){
          header("Location: login.php");  
      }
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
        <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

        <style>
            .gantt_task_line.gantt_dependent_task {
                background-color: #65c16f;
                border: 1px solid #3c9445;
            }

            .gantt_task_line.gantt_dependent_task .gantt_task_progress {
                background-color: #46ad51;
            }

            #idProjectsCheck {
                /* background-color: green */
                padding-left: .5rem;
                padding-top: .5rem;
                height: 65vh;
            }

        </style>

        <script type="text/javascript">
            $(document).ready(function (e) {
                $('#idAvatar').change(function(){
                    let reader = new FileReader();
                    reader.onload = (e) => { 
                        $('#idAvatarPreview').attr('src', e.target.result); 
                        $('#idAvatarPreview').removeClass('hidden');
                    }
                    reader.readAsDataURL(this.files[0]); 
                });

                $('#idProjectMembers').select2({
                    placeholder: 'Select Project Members'
                });

                $('#idTaskMembers').select2({
                    placeholder: 'Select Task Members'
                });

                $('#idProjectStatus').select2({
                    placeholder: 'Select Project Status'
                });

                $('#idTaskStatus').select2({
                    placeholder: 'Select Task Status'
                });
            });
        </script>
        
    </head>
    <body class="font-sans antialiased h-full">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
