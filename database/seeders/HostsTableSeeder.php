<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Host; // Import the Host model

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hosts = [
            [
                'host_name' => 'Prof. Barasa Lwagula (VC)',
                'host_email' => 'vc@au.ac.ke',
                'host_number' => '0712345678'
            ],
            [
                'host_name' => 'Prof. John Chang\'ach (DVC)',
                'host_email' => 'dvc@au.ac.ke',
                'host_number' => '0723456789'
            ],
            [
                'host_name' => 'Dr. Bostley Asenahabi',
                'host_email' => 'ckemboi548@gmail.com',
                'host_number' => '0724460144'
            ],
            [
                'host_name' => 'Dr. Victor Mengwa',
                'host_email' => 'vkirui@au.ac.ke',
                'host_number' => '0711607670'
            ],
            [
                'host_name' => 'Dr. Pamela Nyongesa',
                'host_email' => 'pnyongesa@au.ac.ke',
                'host_number' => '0722334455'
            ],
            [
                'host_name' => 'Dr. Caren Jerop',
                'host_email' => 'cjerop@au.ac.ke',
                'host_number' => '0722334455'
            ],
            [
                'host_name' => 'Genvieve Nasimiyu (Dean of Students)',
                'host_email' => 'deanstudents@au.ac.ke',
                'host_number' => '0722334455'
            ],
            [
                'host_name' => 'Dr. William Okedi (Dean School of Health Science)',
                'host_email' => 'wokedi@au.ac.ke',
                'host_number' => '0718722000'
            ],
            [
                'host_name' => 'Dr. Benard Toboso Mahero (Dean School of education and social sciences)',
                'host_email' => 'tobosomahero@gmail.com',
                'host_number' => '0713058812'
            ],
            [
                'host_name' => 'Dr. Dennis Magero (Dean School of Science Engineering and Technology)',
                'host_email' => 'dmagero@au.ac.ke',
                'host_number' => '0700123456'
            ],
            [
                'host_name' => 'Dr. Arnety Makokha (Dean School of Business Economics and Human Resource Development)',
                'host_email' => 'amakokha@au.ac.ke',
                'host_number' => '0715896140'
            ],
            [
                'host_name' => 'Dr. Morris Mwatu',
                'host_email' => 'mmwatu@au.ac.ke',
                'host_number' => '0721472595'
            ],
            [
                'host_name' => 'Dr. Sarah Bundotich',
                'host_email' => 'sbundotich@au.ac.ke',
                'host_number' => '0721354091'
            ],
            [
                'host_name' => 'Dr. Hillary Oundo Busolo',
                'host_email' => 'hbusolo@au.ac.ke',
                'host_number' => '0722370302'
            ],
            [
                'host_name' => 'Dr. (CPA) Peninah Tanui',
                'host_email' => 'ptanui@au.ac.ke',
                'host_number' => '0723356121'
            ],
            [
                'host_name' => 'Dr. Ruth Adhoch-Odhiambo',
                'host_email' => 'radhoch@yahoo.com',
                'host_number' => '0723678465'
            ],
            [
                'host_name' => 'Dr. Caroline Wakoli',
                'host_email' => 'carolinewakoli@gmail.com',
                'host_number' => '0725162260'
            ],
            [
                'host_name' => 'Mr. Hezekiah Adwar Othoo',
                'host_email' => 'hothoo@au.ac.ke',
                'host_number' => '0728983065'
            ],
            [
                'host_name' => 'Dr. Njue Michael Murimi',
                'host_email' => 'mnjue@au.ac.ke',
                'host_number' => '0720123456'
            ],
            [
                'host_name' => 'Dr. Caroline Ombok',
                'host_email' => 'caroline.ombok@gmail.com',
                'host_number' => '0722392358'
            ],
            [
                'host_name' => 'Dr. Wycliffe Osabwa - Ayieko',
                'host_email' => 'woyieko@au.ac.ke',
                'host_number' => '0722902079'
            ],
            [
                'host_name' => 'Mr. Kelvin Kisaka Juma',
                'host_email' => 'kjuma@au.ac.ke',
                'host_number' => '0728898233'
            ],
            [
                'host_name' => 'Ms. Gladys Nyaiburi Ogaro',
                'host_email' => 'gogaro@auc.ac.ke',
                'host_number' => '0721803609'
            ],
            [
                'host_name' => 'Prof. Wilfred Emonyi Injera',
                'host_email' => 'weinjera@au.ac.ke',
                'host_number' => '0724152908'
            ],
            [
                'host_name' => 'Rev. Dr. Manya Wandefu Stephen',
                'host_email' => 'smanya@au.ac.ke',
                'host_number' => '0719571790'
            ],
            [
                'host_name' => 'Dr. Charles O. Omoga',
                'host_email' => 'domoga@au.ac.ke',
                'host_number' => '0719571797'
            ],
            [
                'host_name' => 'Mr. Kiptanui Chebii',
                'host_email' => 'kchebii@au.ke',
                'host_number' => '0722141994'
            ],
            [
                'host_name' => 'Dr. Boswell Omondi',
                'host_email' => 'bomondi@au.ac.ke',
                'host_number' => '0726177967'
            ],
            [
                'host_name' => 'Dr. Chebii Kiprono',
                'host_email' => 'chebiizk@gmail.com',
                'host_number' => '0700000111'
            ],
            [
                'host_name' => 'Mr. Mwongula Albert',
                'host_email' => 'mwart.mic@gmail.com',
                'host_number' => '0724722889'
            ],
            [
                'host_name' => 'Mr. Korkoren Kenneth',
                'host_email' => 'kcheruiyot@au.ac.ke',
                'host_number' => '0728813804'
            ],
            [
                'host_name' => 'Dr. Onganga Peter Odhiambo',
                'host_email' => 'podhiambo@au.ac.ke',
                'host_number' => '0726700727'
            ],
            [
                'host_name' => 'Mrs. Margret Ngugi',
                'host_email' => 'mngugi@au.ac.ke',
                'host_number' => '0729540811'
            ],
            [
                'host_name' => 'Mr. Eliud K. Koech',
                'host_email' => 'ekoech@au.ac.ke',
                'host_number' => '0735254725'
            ],
            [
                'host_name' => 'Mr. Kevin O. Omondi',
                'host_email' => 'komondi@au.ac.ke',
                'host_number' => '0728894458'
            ],
            [
                'host_name' => 'Dr. Johnstone M Eyinda',
                'host_email' => 'jeyinda@au.ke.ac',
                'host_number' => '0727004941'
            ],
            [
                'host_name' => 'Dr. Muhambe M. Titus',
                'host_email' => 'muhambe@au.ac.ke',
                'host_number' => '+254-720-048445'
            ],
            [
                'host_name' => 'Mr. Stephen Kimei',
                'host_email' => 'skimei@au.ac.ke',
                'host_number' => '0727406293'
            ]
        ];

        foreach ($hosts as $host) {
            Host::updateOrCreate(
                ['host_email' => $host['host_email']], // Check for existing email
                $host // Insert or update the host data
            );
        }
    }
}