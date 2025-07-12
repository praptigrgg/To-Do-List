@extends('main')

@section('title', ' | Home')

@section('styles')
<style>
  body {
    background-color: #faf4f2;
    color: #4b3b40;
  }
  h2 {
    color: #b07c8c;
  }
  .login-note {
    background: #fceff1;
    border-left: 5px solid #d8a7b1;
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1.5rem;
  }
.hero-add-task {
  background: #fff3f6;
  border-left: 6px solid #d8a7b1;
  padding: 2rem;
  border-radius: 20px;
  box-shadow: 0 6px 15px rgba(216, 167, 177, 0.2);
  max-width: 650px;
  margin: 0 auto 2rem auto;
}

.hero-heading {
  font-size: 1.6rem;
  color: #b07c8c;
  margin-bottom: 1rem;
  font-weight: 600;
}

.btn-add-task {
  display: inline-block;
  background-color: #d8a7b1;
  color: white;
  padding: 0.65rem 1.4rem;
  font-size: 1rem;
  border: none;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 4px 10px rgba(216, 167, 177, 0.3);
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-add-task:hover {
  background-color: #b07c8c;
  transform: translateY(-2px);
}


</style>
@endsection

@section('content')
<h2 class="text-center mb-5">Why You'll Love Our To Do List Website</h2>

<ul class="creative-list">
  <li><i class="fas fa-seedling icon"></i>Minimalist, aesthetic task tracking that helps you focus</li>
  <li><i class="fas fa-brain icon"></i>Organize your life with calm clarity and mindful productivity</li>
  <li><i class="fas fa-cloud icon"></i>Cloud-based syncing so your tasks are always with you</li>
  <li><i class="fas fa-lock icon"></i>Secure, private, and free – your data belongs to you</li>
</ul>
<div class="hero-add-task text-center mb-5">
  <h3 class="hero-heading">Want to add a task to your to-do list?</h3>

  @auth
    <a href="{{ route('home') }}" class="btn-add-task mt-3">Add Task</a>
  @else
    <a href="{{ route('login') }}" class="btn-add-task mt-3">Add Task</a>
  @endauth
</div>


<div class="login-note mt-5">
  <strong>Note:</strong> You must <a href="{{ route('login') }}">log in</a> to add or manage tasks.
</div>


<style>
  .creative-list {
    list-style: none;
    max-width: 600px;
    margin: 0 auto;
    padding: 0;
  }

  .creative-list li {
    background: #f8e9ec;
    margin-bottom: 1.3rem;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    font-size: 1.15rem;
    font-weight: 500;
    color: #6e4c59;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 10px rgba(216, 167, 177, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .creative-list li:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(216, 167, 177, 0.5);
  }

  .creative-list .icon {
    color: #d8a7b1;
    margin-right: 1rem;
    font-size: 1.6rem;
    flex-shrink: 0;
  }

  /* Link styling inside the login note */
  .login-note a {
    color: #b07c8c;
    font-weight: 600;
    text-decoration: none;
  }

  .login-note a:hover {
    text-decoration: underline;
  }
</style>
@endsection
