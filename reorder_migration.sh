#!/bin/bash

cd database/migrations/

echo "🔄 Reordering migration files..."

# Rename dengan urutan yang benar
[ -f *_create_students_table.php ] && mv *_create_students_table.php 2025_11_16_000001_create_students_table.php
[ -f *_create_student_details_table.php ] && mv *_create_student_details_table.php 2025_11_16_000002_create_student_details_table.php
[ -f *_create_instructors_table.php ] && mv *_create_instructors_table.php 2025_11_16_000003_create_instructors_table.php
[ -f *_create_instructor_details_table.php ] && mv *_create_instructor_details_table.php 2025_11_16_000004_create_instructor_details_table.php
[ -f *_create_admin_table.php ] && mv *_create_admin_table.php 2025_11_16_000005_create_admin_table.php
[ -f *_create_courses_table.php ] && mv *_create_courses_table.php 2025_11_16_000006_create_courses_table.php
[ -f *_create_subcourses_table.php ] && mv *_create_subcourses_table.php 2025_11_16_000007_create_subcourses_table.php
[ -f *_create_student_course_table.php ] && mv *_create_student_course_table.php 2025_11_16_000008_create_student_course_table.php
[ -f *_create_course_rating_table.php ] && mv *_create_course_rating_table.php 2025_11_16_000009_create_course_rating_table.php

# Hapus migration yang tidak diperlukan (sessions, cache sudah ada)
rm -f *_create_sessions_table.php 2>/dev/null
rm -f *_create_cache_table.php 2>/dev/null

cd ../..

echo "✅ Migration files reordered successfully!"
echo ""
echo "📋 New order:"
ls -1 database/migrations/ | grep create_

echo ""
echo "🚀 Next step: run 'php artisan migrate:fresh'"
