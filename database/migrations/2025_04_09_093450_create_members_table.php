<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng (bigint unsigned)
            $table->string('student_id')->unique()->nullable(); // Mã sinh viên, duy nhất, có thể null
            $table->string('full_name'); // Họ và tên
            $table->string('email')->unique(); // Email, duy nhất
            $table->string('class')->nullable(); // Lớp, có thể null
            $table->string('course_year')->nullable(); // Khóa học, có thể null
            $table->string('username')->unique(); // Tên đăng nhập, duy nhất
            $table->string('password'); // Mật khẩu đã được hash
            $table->string('role')->default('student'); // Vai trò, mặc định là 'student'
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};