<?php

use App\Models\User;
use App\Models\Institution;
use App\Models\Student;
use App\Models\Organization;
use App\Models\InstitutionData;

test('membership number shows affiliation number from organization data when organization is submitted', function () {
    // 1. Create an Institution
    $institution = Institution::create([
        'name' => 'Test Institution',
        'email' => 'inst@test.com',
        'password' => bcrypt('password'),
        'membership_number' => 'MEMB_123',
        'stream' => 'sharia',
        'affiliation_number' => 'INST_AFF_123',
    ]);

    // 2. Create a Student belonging to that institution
    $student = Student::create([
        'institution_id' => $institution->id,
        'name' => 'John Doe',
        'uid' => 'STUD-001',
        'stream' => 'sharia',
        'class' => '10th',
        'status' => 'pending',
    ]);

    // 3. Admin verifies the student (should generate membership number using institution's affiliation_number since no organization is submitted yet)
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'uid' => 'ADMIN-001',
    ]);

    $response = $this->actingAs($admin)
        ->patch(route('admin.student.updateStatus', $student->id), [
            'status' => 'verified',
        ]);

    $response->assertRedirect();
    $student->refresh();

    // Verify the membership number was stored using institution's affiliation_number
    $this->assertEquals('STUD-001/10th/INST_AFF_123/2026-27', $student->getRawOriginal('membership_number'));
    $this->assertEquals('STUD-001/10th/INST_AFF_123/2026-27', $student->membership_number);

    // 4. Now, submit Organization data for this institution
    $org = Organization::create([
        'institution_id' => $institution->id,
        'college_name' => 'Test Institution',
        'affiliation_number' => 'ORG_AFF_456',
        'organization_name' => 'Test Students Org',
        'contact_number' => '1234567890',
        'email' => 'org@test.com',
    ]);

    // Load/refresh the relationship to ensure accessor gets the fresh database state
    $student->load('institution.organization');

    // The accessor should dynamically return the membership number with the organization's affiliation number
    $this->assertEquals('STUD-001/10th/ORG_AFF_456/2026-27', $student->membership_number);
});

test('membership number shows affiliation number from institution data when institution data is submitted', function () {
    $institution = Institution::create([
        'name' => 'Test Institution 2',
        'email' => 'inst2@test.com',
        'password' => bcrypt('password'),
        'membership_number' => 'MEMB_456',
        'stream' => 'sharia',
        'affiliation_number' => 'INST_AFF_123',
    ]);

    $student = Student::create([
        'institution_id' => $institution->id,
        'name' => 'Jane Doe',
        'uid' => 'STUD-002',
        'stream' => 'sharia',
        'class' => '12th',
        'status' => 'pending',
    ]);

    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'uid' => 'ADMIN-001',
    ]);

    // Verify the student
    $this->actingAs($admin)
        ->patch(route('admin.student.updateStatus', $student->id), [
            'status' => 'verified',
        ]);

    $student->refresh();
    $this->assertEquals('STUD-002/12th/INST_AFF_123/2026-27', $student->membership_number);

    // Create InstitutionData using the relation to avoid fillable issues with foreign key
    $institution->institutionData()->create([
        'college_name' => 'Test Institution 2',
        'stream' => 'sharia',
        'affiliation_number' => 'DATA_AFF_789',
        'full_address' => 'Some address',
        'college_organization_full_name' => 'Test Org',
        'college_organization_short_name' => 'TO',
        'email' => 'org@test.com',
        'organization_director_name' => 'Director',
        'organization_director_contact' => '123',
        'chairman_name' => 'Chairman',
        'chairman_contact' => '456',
        'convener_name' => 'Convener',
        'convener_contact' => '789',
        'treasurer_name' => 'Treasurer',
        'treasurer_contact' => '012',
        'councilers_name_contact' => 'Councilers info',
    ]);

    // Refresh the loaded relationship
    $student->load('institution.institutionData');

    // The accessor should dynamically return the membership number with the institution data's affiliation number
    $this->assertEquals('STUD-002/12th/DATA_AFF_789/2026-27', $student->membership_number);
});

test('existing student membership numbers in database are updated when organization details are saved or updated', function () {
    $institution = Institution::create([
        'name' => 'Test Institution 3',
        'email' => 'inst3@test.com',
        'password' => bcrypt('password'),
        'membership_number' => 'MEMB_789',
        'stream' => 'sharia',
        'affiliation_number' => 'INST_AFF_123',
    ]);

    $student = Student::create([
        'institution_id' => $institution->id,
        'name' => 'Bob Smith',
        'uid' => 'STUD-003',
        'stream' => 'sharia',
        'class' => '10th',
        'status' => 'verified',
        'membership_number' => 'STUD-003/10th/INST_AFF_123/2026-27',
    ]);

    // Act as the institution and submit organization details
    $response = $this->actingAs($institution, 'institution')
        ->post(route('institution.organization.save'), [
            'college_name' => 'Test Institution 3',
            'affiliation_number' => 'NEW_ORG_AFF',
            'organization_name' => 'New Org Name',
            'contact_number' => '9876543210',
            'email' => 'neworg@test.com',
        ]);

    $response->assertRedirect();

    // Verify the raw database value has been updated
    $student->refresh();
    $this->assertEquals('STUD-003/10th/NEW_ORG_AFF/2026-27', $student->getRawOriginal('membership_number'));
});

test('organization data is shown on boys and girls admin dashboards', function () {
    // Create boys institution (Sharia)
    $boysInstitution = Institution::create([
        'name' => 'Boys Institution',
        'email' => 'boysinst@test.com',
        'password' => bcrypt('password'),
        'membership_number' => 'BOYS_MEMB',
        'stream' => 'sharia',
        'affiliation_number' => 'BOYS_AFF_1',
    ]);

    // Create girls institution (She)
    $girlsInstitution = Institution::create([
        'name' => 'Girls Institution',
        'email' => 'girlsinst@test.com',
        'password' => bcrypt('password'),
        'membership_number' => 'GIRLS_MEMB',
        'stream' => 'she',
        'affiliation_number' => 'GIRLS_AFF_1',
    ]);

    // Create organization for boys institution
    Organization::create([
        'institution_id' => $boysInstitution->id,
        'college_name' => 'Boys Institution',
        'affiliation_number' => 'BOYS_ORG_AFF',
        'organization_name' => 'Boys Students Org',
        'contact_number' => '1234567890',
        'email' => 'boysorg@test.com',
    ]);

    // Create organization for girls institution
    Organization::create([
        'institution_id' => $girlsInstitution->id,
        'college_name' => 'Girls Institution',
        'affiliation_number' => 'GIRLS_ORG_AFF',
        'organization_name' => 'Girls Students Org',
        'contact_number' => '0987654321',
        'email' => 'girlsorg@test.com',
    ]);

    // Create admin users
    $boysAdmin = User::create([
        'name' => 'Boys Admin',
        'email' => 'boysadmin@test.com',
        'password' => bcrypt('password'),
        'role' => 'boys_admin',
        'uid' => 'boysadmin_test',
    ]);

    $girlsAdmin = User::create([
        'name' => 'Girls Admin',
        'email' => 'girlsadmin@test.com',
        'password' => bcrypt('password'),
        'role' => 'girls_admin',
        'uid' => 'girlsadmin_test',
    ]);

    // 1. Visit boys dashboard as boys admin
    $response = $this->actingAs($boysAdmin)
        ->get(route('admin.boys.dashboard'));
    $response->assertStatus(200);
    $response->assertSee('Boys Students Org');
    $response->assertSee('BOYS_ORG_AFF');
    $response->assertDontSee('Girls Students Org');

    // 2. Visit girls dashboard as girls admin
    $response = $this->actingAs($girlsAdmin)
        ->get(route('admin.girls.dashboard'));
    $response->assertStatus(200);
    $response->assertSee('Girls Students Org');
    $response->assertSee('GIRLS_ORG_AFF');
    $response->assertDontSee('Boys Students Org');
});
