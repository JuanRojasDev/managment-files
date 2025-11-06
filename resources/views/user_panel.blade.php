@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Panel de Usuario</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" name="file" id="fileInput" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Subir archivo</button>
            </form>
            <div class="progress mt-3" style="height: 20px; display:none;" id="progressBarContainer">
                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%">0%</div>
            </div>
            <div id="notification" class="mt-3"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Mis archivos</h4>
            <div id="userFiles"></div>
            <div id="storageUsage" class="mt-2"></div>
        </div>
    </div>
</div>
<script src="/js/user.js"></script>
@endsection
