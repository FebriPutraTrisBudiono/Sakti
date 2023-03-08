<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/css/bootstrap.min.css' ?>">
    <style>
        /* Style Buat Header Dan Foter */
        @page {
            margin: 150px 50px 100px 50px;
        }

        header {
            position: fixed;
            /* top: -80px; */
            top: -100px;
            left: 0px;
            right: 0px;
        }

        header2 {
            position: fixed;
            top: -100px;
            left: 550px;
            right: 0px;
        }

        .pagenum:before {
            content: counter(page);
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 30px;
            right: 50px;
            height: 50px;
            /* margin: 0 auto; */

            /** Extra personal styles **/
            background-color: #00869e;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer_color_1 {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 50px;
            /* width: 23.33%; */
            /* float: left; */
            height: 50px;

            /** Extra personal styles **/
            background-color: #3d83c2;
            line-height: 35px;
            /* width: 20px; */
        }

        footer_color_2 {
            position: fixed;
            bottom: -60px;
            left: 640px;
            right: 0px;
            /* width: 23.33%; */
            /* float: right; */
            height: 50px;

            /** Extra personal styles **/
            color: white;
            background-color: #d04648;
            line-height: 35px;
            /* width: 20px; */
        }

        .spacing {

            word-spacing: 150px;

        }

        /* Penutup Style Buat Header Dan Foter */

        table,
        th,
        td {
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Dotted red border */
    </style>
    <title>Document</title>
</head>

<body>
    {{-- <table style="border: 1px;">
        <tbody>
            <tr>
                <th scope="row" style="border: 1px;">
                    <img src="{{ $setting->main_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}"
                        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
                </th>
                <td style="border: 1px; text-align: right;">
                    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
                        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
                </td>
            </tr>
        </tbody>
    </table> --}}

    <!-- Buat Header Dan Foter  -->
    <header>
        <!-- Our Code World -->
        <img src="{{ $setting->doc_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->doc_logo : '/assets/img/noimage.jpeg' }}"
            class="img-thumbnail main_logoPreview" width="160px" style="border: none">
    </header>

    <header2>
        <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
            class="img-thumbnail main_logoPreview" width="160px" style="border: none">
    </header2>

    <footer_color_1>
    </footer_color_1>
    <footer>
        <p>DOC-CER-01 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; Rev.04 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; Tanggal terbit: 01.10.20</p>
    </footer>
    <footer_color_2>
        <span class="pagenum" style="position: fixed; right:23px; top:1;"></span>
    </footer_color_2>


    <center class="mt-2 mb-4">
        <h3 style="text-decoration: underline;">KONTRAK SERTIFIKASI</h3>
    </center>

    <p>Kontrak sertifikasi ini dibuat pada tanggal ditandatangani, disini antara: </p>

    <p><b>PIHAK (1)</b> <b>{{ $setting->name }}</b> yang beralamat di <b>{{ $setting->address }}</b>, dan</p>

    <p><b>PIHAK (2)</b> <b>{{ $kajianclient->a1_nama }}</b> yang beralamat di <b>{{ $kajianclient->a2_alamat }}</b>
        mengetahui perwakilan dari Pihak (2) <b>{{ $kajianclient->a8_nampim }}</b></p>

    <label for="">Lokasi klien:</label>
    <ol type=1>
        <li>
            lokasi pusat :
        </li>
        <li>
            lokasi cabang 1 (jika ada) :
        </li>
        <li>
            lokasi cabang ada 2 (jika ada) :
        </li>
    </ol>

    <div class="row mb-2" style="text-align:justify">
        <label for="">Apabila dalam pelaksanaan Perjanjian Bersama ini para PIHAK merasa perlu
            melakukan perubahan, maka perubahan tersebut hanya dapat dilakukan atas kesepakatan PARA PIHAK yang
            dituangkan dalam Addendum Perjanjian ini dan merupakan bagian yang tidak dapat
            dipisahkan dari Perjanjian ini.</label>
    </div>

    <div class="form-group mb-2" style="text-align:justify">

        <h6>1. PENDAHULUAN</h6>
        <ul>
            <li>
                SIS menilai sistem manajemen klien atau bagiannya, dengan tujuan untuk
                menentukan kesesuaian
                dengan persyaratan yang disepakati dan diakui, seperti
                internasional, nasional atau standar sektor tertentu atau spesifikasi.
            </li>
            <li>
                Proses penilaian ini dapat melibatkan satu atau lebih tahapan, biasanya diakhiri
                dengan laporan audit yang merupakan dokumentasi dari hasil audit. Dalam hal jasa
                sertifikasi, SIS akan mengeluarkan sertifikat khusus kepada klien, sebagai bagian
                dalam mengkonfirmasi kesesuaian dari persyaratan-² yang telah ditentukan, ketika
                semua persyaratan secara jelas terbukti dipenuhi.
            </li>
            <li>
                Jika terdapat ketidaksesuaian terhadap persyaratan dari standar atau spesifikasi
                teridentifikasi pada saat audit, klien harus membuat rencana tindakan perbaikan dan
                dan dilaksanakan oleh Klien dalam jangka waktu tertentu.
            </li>
            <li>
                Sertifikat hanya akan diterbitkan setelah rencana tindakan perbaikan dilaksanakan
                secara efektif yang ditunjukkan dengan bukti yang jelas. Ruang lingkup dan jangka
                waktu validitas sertifikat akan dicantumkan pada sertifikat.
            </li>
            <li>
                SIS dan Klien setuju bahwa evaluasi dan/atau sertifikasi dari sistem manajemen Klien
                harus dilakukan sesuai dengan standar yang berlaku, persyaratan industri terkait (jika
                berlaku) dan perjanjian audit dan sertifikasi, termasuk dokumen ini dan setiap
                dokumen yang dilampirkan ke dalamnya atau disebut di dalamnya.
            </li>
            <li>
                SIS bertindak independen, netral dan obyektif dalam audit dan sertifikasi. Audit
                dilakukan di tempat kerja klien. Jenis, luas dan jadwal dari prosedur dapat diatur
                pada perjanjian terpisah dari para pihak. Sakti Indonesia Sertifikasi berusaha untuk
                meminimalkan gangguan kepada proses bisnis pada saat melakukan audit di tempat
                Klien.
            </li>
        </ul>
    </div>

    <div class="form-group" style="text-align:justify">
        <h6>2. PROSES SERTIFIKASI MELIPUTI LANGKAH-LANGKAH BERIKUT:</h6>
        <h6>2.1 PERMOHONAN SERTIFIKASI</h6>
        <label for="">Klien mengajukan permohonan sertifikasi sesuai formulir permohonan yang telah
            ditetapkan SIS. Apabila dibutuhkan, SIS dapat memberikan penjelasan rinci mengenai
            proses sertifikasi sesuai skema yang telah ditetapkan. </label>
        <ul>
            <li>
                Klien harus berbadan hukum yang sah;

            </li>
            <li>
                menerapkan persyaratan standar sistem manajemen yang akan disertifikasi dan;

            </li>
            <li>
                bersedia mematuhi persyaratan umum sertifikasi yang telah ditetapkan, serta
                bersedia membayar biaya-² terkait dengan kegiatan sertifikasi yang telah disepakati;
            </li>
            <li>
                Formulir permohonan sertifikasi harus ditandatangani oleh pimpinan organisasi
                sebagai bagian penting dari perjanjian sertifikasi dengan SIS;
            </li>
            <li>
                SIS akan meninjau setiap data dan informasi yang diterima, untuk keperluan
                perencanaan dan pelaksanaan kegiatan sertifikasi;

            </li>
            <li>
                SIS menjamin kerahasiaan setiap data dan informasi yang diterima dari Klien/
                pemohon sertifikasi.

            </li>
        </ul>


        <h6>2.2 PROSES AUDIT</h6>
        <h6>AUDIT STAGE I</h6>
        <ul>
            <li>
                SIS akan menentukan tim audit yang kompeten sesuai dengan ruang lingkup
                sertifikasi dan standar sistem manajemen yang diaplikasikan. Program dan rencana
                setiap tahapan audit akan diinformasi kepada klien sebelum pelaksanaan audit;
            </li>

            <li>
                Audit stage I akan dilakukan oleh tim audit di tempat klien atau di kantor SIS, untuk
                mengaudit:
            </li>
            <div class="form-group">
                <ol type=1>
                    <li>dokumen sistem manajemen,</li>
                    <li>memverikasi kesiapan lokasi dan lapangan,</li>
                    <li>mengecek status kinerja utama dan aspek-² penting yang relevan,</li>
                    <li>pelaksanaan internal audit dan tinjauan manajemen serta,</li>
                    <li>mengumpulkan informasi yang relevan dan mengkaji kesiapan sumber daya
                        klien untuk persiapan pelaksanaan audit stage II.</li>
                </ol>
            </div>
            <li>
                Tim audit akan memberikan laporan tertulis hasil audit stage I termasuk rekomendasi untuk pelaksanaan
                audit
                stage II.
            </li>
        </ul>
        <h6>AUDIT STAGE II</h6>
        <ul>
            <li>Audit stage II dilakukan di lokasi klien sesuai dengan ruang lingkup sertifikasi dan
                standar yang diterapkan. Audit stage II bertujuan untuk:
            </li>
            <div class="form-group">
                <ol type=1>
                    <li>memverikasi efektifitas penerapan sistem manajemen yang diterapkan oleh klien
                        sesuai dengan ruang lingkupnya.</li>
                </ol>
                <li>Semua informasi hasil audit stage I dan stage II akan digunakan oleh tim audit untuk
                    memberikan kesimpulan hasil audit terkait dengan rekomendasi keputusan sertifikasi.</li>
                <li>Apabila ditemukan ketidaksesuaian, maka klien harus melakukan koreksi dan
                    tindakan koreksi sesuai dengan batas waktu yang telah ditetapkan oleh SIS</li>
        </ul>
        <h6>KEPUTUSAN SERTIFIKASI</h6>
        <ul>
            <li>SIS akan melakukan serangkaian proses internal untuk mengkaji semua laporan
                audit dalam rangka membuat keputusan sertifikasi. </li>
            <li>Proses pengkajian dilakukan secara professional, tidak memihak dan independen
                serta dilakukan oleh personel yang kompeten. </li>
            <li>Klien akan diberikan konfirmasi keputusan sertifikasi secara tertulis oleh SIS. </li>
            <li>Sertifikat sistem manajemen akan diterbitkan dan diberikan kepada Klien apabila
                semua persyaratan sertifikasi telah terpenuhi. </li>
            <li>Sertifikat yang diterbitkan oleh SIS berlaku selama 3 (tiga) tahun.</li>
            <li>Klien dapat menggunakan logo sertifikasi dan/atau logo akreditasi sesuai dengan
                aturan yang telah ditetapkan. Informasi umum mengenai klien tersetifikasi akan
                dimasukan dalam Direktori Klien tersertifikasi SIS. </li>
        </ul>
        <h6>SURVAILEN</h6>
        <ul>
            <li>Audit Surveilen akan dilakukan secara periodik (satu tahun sekali atau dua kali) oleh
                tim audit yang kompeten untuk mengevaluasi efektivitas penerapan dan
                pemeliharaan sistem manajemen klien yang telah tersertifikasi. </li>
            <li>Tim audit akan membuat laporan tertulis hasil audit surveilen dan klien wajib untuk
                melakukan koreksi dan tindakan korektif atas setiap temuan ketidaksesuaian hasil
                audit surveilen sesuai batas waktu yang telah ditentukan.
            </li>
        </ul>
        <h6>RESERTIFIKASI</h6>
        <ul>
            <li>Audit resertifikasi dilakukan pada akhir masa berlaku sertifikat. </li>
            <li>Tujuan audit sertifikasi ulang adalah untuk</li>
            <div class="form-group">
                <ol type=1>
                    <li>mengkonfirmasi keberlanjutan kesesuaian dan efektifitas sistem manajemen
                        secara keseluruhan, serta</li>
                    <li>relevansi dan kemampuan organisasi terhadap lingkup sertifikasi.</li>
                </ol>
            </div>
            <li>Apabila ditemukan ketidaksesuaian, maka klien harus melakukan koreksi dan
                tindakan korektif sesuai dengan batas waktu yang telah ditetapkan oleh SIS. </li>
            <li>SIS akan menerbitkan ulang sertifikat untuk masa berlaku 3 (tiga) tahun berikutnya
                apabila semua persyaratan terkait resertifikasi telah terpenuhi.
            </li>
        </ul>
    </div>

    <div class="form-group" style="text-align:justify">
        <h6>3 HAK DAN KEWAJIBAN KLIEN</h6>
        <h6>3.1 MEMPERTAHANKAN SISTEM MANAJEMEN</h6>
        <ul>
            <li>
                Dalam rangka mendapatkan dan mempertahankan sertifikat,
            </li>
            <li>Klien harus menerapkan dan memelihara sistem manajemen yang telah terdokumentasi yang memenuhi
                persyaratan
                dari standar yang dipilih. </li>
            <li>Klien harus memberikan bukti kesesuaian dan efektivitas sistem manajemen yang
                telah diterapkan,</li>
            <li>Klien harus melakukan semua tindakan yang diperlukan untuk memastikan bahwa
                sistem manajemennya telah dipelihara secara efektif dan sesuai setiap saat.
            </li>
        </ul>

        <h6>3.2 AKSES KE INFORMASI</h6>
        <ul>
            <li>Klien memastikan bahwa SIS memiliki akses ke semua informasi yang diperlukan
                dan fasilitas yang diperlukan untuk melakukan tugas-² audit. </li>
            <li>Klien yang terdiri dari perwakilan dan karyawannya berkomitmen untuk memberikan
                kepada auditor informasi yang akurat dan lengkap secara tepat waktu yang berkaitan dengan semua proses
                yang
                mungkin signifikan untuk audit</li>
            <li>Dalam lingkup sistem manajemen yang bersertifikasi, semua catatan yang berkaitan
                dengan keluhan dan tindakan perbaikan mereka akan disampaikan kepada SIS
                apabila diminta.</li>
        </ul>

        <h6>3.3 PEMBERITAHUAN PERUBAHAN</h6>
        <ul>
            <li>Klien berkewajiban untuk menginformasikan segera kepada SIS terkait dengan
                perubahan kontak, lokasi dan alamat.
            </li>
            <li>Klien berkewajiban untuk menginformasikan segera kepada SIS jika ada perubahan
                yang mungkin mempengaruhi sistem manajemen yang telah tersertifikasi. Hal ini
                berlaku khususnya pada: </li>
            <div class="form-group">
                <ol type=1>
                    <li>pembelian/penjualan dari semua atau sebagian dari perusahaan, </li>
                    <li>perubahan kepemilikan, </li>
                    <li>perubahan besar pada operasi,</li>
                    <li>perubahan mendasar dalam proses atau kebangkrutan atau komposisi proses.</li>
                </ol>
            </div>
            <li>Dalam tiap kasus ini SIS akan berkonsultasi dengan Klien dan menentukan bagaimana sertifikat dapat
                dipertahankan.</li>
        </ul>

        <h6>3.4 HAK UNTUK MENOLAK AUDITOR</h6>
        <ul>
            <li>Sebelum ada konfirmasi tanggal dilakukannya audit, Klien berhak untuk meninjau
                dan menolak auditor yang ditugaskan oleh Sakti Indonesia Sertifikasi dengan alasan
                yang tepat.</li>
            <li>Dalam hal ini SIS akan menugaskan penggantinya dari auditor yang ditolak.</li>
        </ul>

        <h6>3.5 KERAHASIAAN DAN KEAMANAN INFORMASI</h6>
        <ul>
            <li>Dokumen yang diberikan kepada klien oleh SIS, diantaranya adalah laporan audit,
                sertifikat, termasuk logo sertifikasi SIS dilindungi oleh hak cipta. </li>
            <li>Klien mengakui bahwa semua dokumen yang diberikan atau disediakan oleh SIS
                tetap menjadi milik SIS, dan digunakan hanya untuk kebutuhan internal klien dan
                tidak dapat diberikan kepada pihak ketiga atau digunakan untuk tujuan selain yang
                disepakati disini atau dalam bentuk tertulis.</li>
            <li>Klien berkewajiban untuk menjaga kerahasiaan tentang informasi yang terdapat
                dalam Perjanjian serta semua pengetahuan yang berhubungan dengan SIS,
                karyawannya dan auditornya.
            </li>
            <li>Kewajiban ini juga berlaku setelah pemutusan kontrak. Klien menerima kewajiban ini
                atas nama perwakilan agen serta tambahan personilnya. Klien dibolehkan untuk
                meneruskan laporan audit secara keseluruhan. Penyampaian intisari dari laporan
                tidak diiizinkan.
            </li>
        </ul>
        <br>
        <h6>3.6 HAK PENGGUNAAN SERTIFIKASI DAN LOGO</h6>
        <ul>
            <li>Dengan sertifikasi SIS yang valid, klien berhak menggunakan sertifikat dan logo
                sertifikasi untuk tujuan promosi;
            </li>
            <li>Penggunaan hak cipta resmi logo sertifikasi SIS (selanjutnya disebut “Logo”) akan
                meningkatkan kepercayaan dari customer terhadap sistem manajemen klien dan
                kinerjanya;
            </li>
            <li>Logo-² ini dapat digunakan pada: </li>
            <div class="form-group">
                <ol type=1>
                    <li>kertas surat perusahaan, </li>
                    <li>brosur, </li>
                    <li>internet atau pameran,</li>
                    <li>dikendaraan atau untuk iklan.</li>
                </ol>
            </div>
            <li>Logo berhubungan langsung dengan organisasi yang telah tersertifikasi dan sistem
                manajemennya;</li>
            <li>Sertifikasi dan Logo bisa digunakan untuk promosi sesuai dengan ketentuan
                Peraturan Sertifikasi dan Audit ini;</li>
            <li>Penggunaannya terbatas oleh ruang lingkup dan masa berlaku sertifikasi;</li>
            <li>Logo tidak boleh terpasang langsung pada produk atau digunakan sedemikian rupa
                untuk menimbulkan kesan yang terkait dengan:</li>
            <div class="form-group">
                <ol type=1>
                    <li>kesesuaian produk dengan standar atau spesifikasinya. </li>
                </ol>
            </div>
            <li>Harus memastikan setiap saat bahwa segala hal yang merujuk kepada sertifikat tidak
                menyesatkan, termasuk namun tidak terbatas pada materi promosi dan iklan;
            </li>
            <li>Klien tidak diperbolehkan menggunakan logo dan sertifikat diluar lingkup sertifikasi
                yang telah diberikan oleh SIS;</li>
            <li>Klien tidak menggunakan sertifikatnya sedemikian rupa sehingga mengakibatkan
                reputasi SIS menjadi buruk serta tidak membuat pernyataan terkait sertifikatnya yang
                dianggap SIS menyesatkan atau tidak sah;</li>
            <li>SIS berkewajiban untuk memastikan penggunaan yang tepat dari logo sertifikat.</li>
        </ul>

        <h6>3.7 BANDING DAN KELUHAN</h6>
        <ul>
            <li>Setiap klien SIS mempunyai hak untuk mendapatkan layanan sesuai dengan ruang
                lingkup yang telah disepakati, sehingga semua harapan dan persyaratan terpenuhi;
            </li>
            <li>Dalam hal tidak memenuhi kesepakatan, klien berhak mengajukan keluhan kepada
                SIS. SIS akan meminta informasi yang dibutuhkan untuk analisa dan perbaikan;</li>
            <li>Dalam hal terjadinya perbedaan pendapat atau tidak setuju dengan keputusan
                dengan tim audit dari SIS atau keputusan sertifikasi tertentu, klien berhak untuk
                mengajukan banding kepada SIS;</li>
            <li>Klien dapat mengajukan banding secara tertulis ditujukan kepada Direktur SIS;</li>
            <li>Manajemen SIS akan memproses setiap Banding secara adil dan akan menindaklanjutinya secara professional
                dan
                independen melalui tim banding;</li>
            <li>Klien akan diberikan laporan tertulis mengenai status bandingnya.</li>
        </ul>
    </div>

    <div class="form-group" style="text-align:justify">
        <h6>4 HAK DAN KEWAJIBAN SIS</h6>
        <h6>4.1 PENILAIAN SISTEM MANAJEMEN</h6>
        <ul>
            <li>SIS memverifikasi kesesuaian dan keefektifan dari sistem manajemen klien yang
                telah memperoleh sertifikasi dengan melakukan audit berkala (biasanya per enam
                bulan atau per duabelas bulan);</li>
            <li>Untuk tujuan audit ini SIS berhak untuk mengakses fasilitas Klien di dalam kerangka
                kerja kunjungan audit yang telah:</li>
            <div class="form-group">
                <ol type=1>
                    <li>direncanakan, </li>
                    <li>mengawasi pelaksanaan kerja</li>
                    <li>menginspeksi proses, produk dan layanan,</li>
                    <li>mewawancarai karyawan dan perwakilannya, </li>
                    <li>meninjau dokumen dan catatan-² yang berkaitan, dan</li>
                    <li>mengumpulkan informasi dengan teknik audit lainnya.</li>
                </ol>
            </div>
            <li>Apabila SIS menerima informasi dari pihak ketiga yang memperdebatkan kesesuaian atau keefektifan dari
                sistem
                manajemen yang telah disertifikasi oleh SIS, maka
                SIS berhak untuk melakukan audit tambahan setelah berkonsultasi dengan Klien;</li>
            <li>Di wilayah yang diatur secara hukum, SIS berhak untuk melakukan audit tambahan
                tanpa pemberitahuan terlebih dahulu.</li>
        </ul>

        <h6>4.2 AKREDITASI</h6>
        <ul>
            <li>SIS diberi wewenang oleh badan akreditasi serta pemerintah dan non-pemerintah
                yang berwenang untuk mengeluarkan laporan audit dan sertifikat sesuai dengan
                standar dan spesifikasi yang berbeda-²;</li>
            <li>Hal ini mencakup kewajiban untuk memperbolehkan karyawan dan karyawan
                tambahannya dari badan-² akreditasi ini untuk berpartisipasi dalam melakukan audit;</li>
            <li>Menurut peraturan akreditasi dan otorisasi yang berlaku, SIS memperbolehkan
                karyawan-² ini mengakses dokumen dan data-² yang berhubungan dengan klien,
                tunduk kepada persyaratan kerahasiaan yang ditetapkan di sini;</li>
            <li>Selain itu setiap kali standar atau spesifikasi individu secara eksplisit dibutuhkan,
                data yang berhubungan dengan klien dan hasil penilaian diteruskan kepada badanbadan ini;</li>
            <li>Dengan menerima kontrak sertifikasi ini Klien menyetujui persyaratan akreditasi yang
                berlaku, termasuk peraturan sebelumnya;</li>
            <li>SIS berhak menugaskan audit dan tugas sertifikasi kepada mitra SIS yang
                memegang akreditasi yang disyaratkan;</li>
            <li>Bilamana sertifikat dikeluarkan oleh mitra SIS semua hak-² dan kewajiban yang
                relevan di sini berlaku sama dengan Sakti Indonesia Sertifikasi.</li>
        </ul>

        <h6>4.3 PENUGASAN AUDITOR</h6>
        <ul>
            <li>Penugasan auditor yang kompeten adalah tanggungjawab utama SIS;</li>
            <li>SIS setuju untuk menggunakan auditor yang hanya mempunyai kualifikasi untuk
                tugas yang diberikan berdasarkan kualifikasi teknik mereka, pengalaman dan
                kemampuan personal mereka;</li>
            <li>Auditor harus memiliki otorisasi untuk standar yang telah disyaratkan dan harus
                mempunyai pengalaman yang memadai di area operasional Klien serta dalam bidang
                manajemen dan audit;</li>
            <li>Dalam banyak kasus SIS dapat menugaskan satu tim audit yang terdiri dari dua atau
                lebih auditor sesuai dengan spesifikasi audit atau proses sertifikasi;</li>
            <li>Apabila diperlukan, SIS akan memberikan riwayat hidup singkat dari auditor yang
                dipilih kepada Klien;</li>
            <li>Jika auditor yang telah ditunjuk tidak dapat tersedia sebelum atau selama audit,
                maka SIS akan menyediakan penggantian yang sesuai untuk kegiatan audit tersebut.
            </li>
        </ul>

        <h6>4.4 PENJADWALAN AUDIT</h6>
        <ul>
            <li>SIS berhak untuk menjadwalkan audit sistem manajemen dari klien;</li>
            <li>Audit akan dijadwalkan dengan waktu yang memberikan kenyamanan pada kedua
                belah pihak yang diamanatkan oleh persyaratan yang berlaku;</li>
            <li>Audit akan dijadwalkan dengan waktu yang memberikan kenyamanan pada kedua
                belah pihak yang diamanatkan oleh persyaratan yang berlaku;</li>
            <li>Ketika sudah disetujui maka tanggal audit tersebut bersifat mengikat;</li>
            <li>Persyaratan audit dapat meliputi ketentuan untuk kompensasi pembatalan atau
                penundaan audit yang telah dikonfirmasi sebelumnya.
            </li>
        </ul>

        <h6>4.5 PENERBITAN SERTIFIKAT</h6>
        <ul>
            <li>SIS akan menerbitkan SIS Sertifikasi (selanjutnya disebut “Sertifikat”) dan memberikannya kepada klien
                setelah pemenuhan persyaratan sertifikasi dan kewajiban
                kontrak oleh klien terpenuhi;</li>
            <li>Keputusan sertifikasi merupakan tanggungjawab utama SIS, berdasarkan
                rekomendasi untuk penerbitan sertifikat oleh auditor dan hasil audit seperti yang
                dicatat dalam laporan audit;</li>
            <li>Sertifikat SIS berlaku untuk jangka waktu tertentu, biasanya maksimal tiga tahun,
                dimulai dari tanggal penerbitan sertifikat.
            </li>
        </ul>

        <h6>4.6 KERAHASIAAN DAN PERLINDUNGAN DATA</h6>
        <ul>
            <li>SIS (temasuk setiap anggota komite, subkontrak, personel lembaga eksternal atau
                individu yang bertindak atas nama PT. Sakti Indonesia Sertifikasi) berkomitmen untuk
                melindungi kerahasiaan dari informasi yang bersifat rahasia dari klien yang tidak
                tersedia untuk publik tetapi tersedia untuk Sakti Indonesia Sertifikasi dalam konteks
                kegiatan dan tempat dari klien, apakah informasi ini berhubungan dengan masalah
                internal klien atau hubungan bisnis;
            </li>
            <li>Hal ini juga berlaku untuk hasil verbal maupun tertulis dari audit. SIS akan
                mengungkapkan informasi yang bersifat rahasia kepada pihak ketiga hanya dengan
                otorisasi tertulis dari klien, kecuali secara eksplisit diberikan dalam peraturan
                sertifikasi dan penilaian ini;
            </li>
            <li>SIS menyimpan semua catatan yang berhubungan dengan audit selama minimal dua
                siklus sertifikasi (biasanya enam tahun);
            </li>
            <li>Komitmen ini juga berlaku setelah berakhirnya kontrak.</li>
        </ul>

        <h6>4.7 PUBLIKASI</h6>
        <ul>
            <li>SIS berhak untuk memelihara dan menerbitkan sebuah daftar dari seluruh klien yang
                memegang sertifikat SIS;
            </li>
            <li>Publikasi ini berisi nama dan alamat dari organisasi yang telah sertifikasi serta ruang
                lingkup dan standar/spesifikasi dan status sertifikasinya;</li>
            <li> Klien dengan ini setuju untuk publikasi informasi seperti di bawah ini.</li>
        </ul>

        <h6>4.8 KOMUNIKASI ELEKTRONIK</h6>
        <ul>
            <li>Sekalipun demikian, klien dengan ini memberi kuasa kepada SIS untuk mengirimkan
                informasi rahasia yang tidak terenkripsi dan informasi lainnya melalui Internet atau
                jaringan publik ke alamat email atau lokasi lain yang disediakan oleh klien;</li>
            <li>Klien menyatakan bahwa SIS tidak dapat menjamin privasi dan kerahasiaan dari
                transmisi seperti itu;</li>
            <li>Klien setuju bahwa transmisi informasi rahasia dari SIS via Internet atau jaringan
                publik lainnya bukan merupakan suatu pelanggaran terhadap kewajiban kerahasiaan di bawah kontrak
                sertifikasi
                ini dan bahwa SIS tidak bertanggung jawab atas segala kerusakan yang dihasilkan dari transmisi seperti
                itu,
                dengan catatan bahwa informasi rahasia seperti itu ditangani dengan tingkat yang sama seperti Sakti
                Indonesia Sertifikasi menangani informasi rahasianya sendiri</li>
            <li>Jika Klien membuat penghubung (link) ke website SIS, Klien setuju:</li>
            <div class="form-group">
                <ol type=1>
                    <li>informasi yang tercantum dalam website SIS adalah milik SIS; </li>
                    <li>link website akan mentransfer pengguna langsung ke website SIS seperti yang
                        dipasang oleh SIS tanpa memaksakan kerangka, jendela perambah atau isi
                        pihak ketiga; dan</li>
                    <li>website penghubung tidak boleh menyatakan atau mengartikan bahwa Klien
                        atau produk atau layanannya didukung oleh SIS.</li>
                </ol>
            </div>
        </ul>
    </div>

    <div class="form-group" style="text-align:justify">
        <h6>5. SERTIFIKAT DAN LOGO</h6>
        <h6>5.1 PENERBITAN DAN PENGGUNAAN LOGO</h6>
        <ul>
            <li>SIS menerbitkan sertifikat yang menegaskan kesesuaian sistem manajemen klien
                terhadap standar nasional dan internasional serta industri yang diakui atau persyaratan khusus
                pelanggan,
                jika klien telah membuktikan pada saat audit bahwa
                semua persyaratan yang berlaku telah dipenuhi;</li>
            <li>Klien berhak menggunakan sertifikat dan logo sertifikasi yang berkaitan untuk
                mempromosikan kepercayaan dengan mitra bisnis;</li>
            <li>Setelah penerbitan sertifikat, survailen akan dilakukan secara terjadwal oleh SIS
                untuk memastikan bahwa kesesuaian sistem manajemen dipelihara oleh klien secara
                terus menerus. Pembentukan dan pemeliharaan sertifikasi melalui kegiatan survailen
                ini bergantung pada pelaksanaan audit dan kesepakatan sertifikasi dan kepatuhan
                terhadap syarat dan kondisi oleh klien;</li>
            <li>Klien setuju bekerja sama dengan SIS dalam memastikan fakta-² jika sistem
                manajemen klien, proses, barang atau jasa tidak ada kesesuaian dengan peraturan,
                undang-², sertifikasi atau persyaratan yang berlaku lainnya, termasuk berbagi
                informasi seperti yang klien minta mengenai laporan ketidaksesuaian, dan untuk
                mengambil dan melaporkan ke SIS mengenai tindakan perbaikan yang diperlukan;
            </li>
            <li>Klien setuju bahwa survailen, seperti audit lanjutan (follow-up audit) dan setiap audit
                khusus yang dilakukan oleh SIS dirancang hanya untuk memeriksa dan menentukan
                kesesuaian dari sistem manajemen dengan persyaratan sertifikasi, dan bahwa klien
                sama sekali tidak dibebaskan dari tanggungjawabnya untuk sistem manajemen,
                proses, barang dan jasa dalam ruang lingkup sertifikasi</li>
            <li>Sertifikat dan Logo Sertifikasi tidak boleh diteruskan entitas lain selain yang tertera
                dalam sertifikat;</li>
            <li>Setelah sertifikat berakhir atau ditangguhkan, ditarik atau dibatalkan, klien harus
                menghentikan promosi atau penggunaan lainnya dari sertifikasi;</li>
            <li>Klien setuju untuk mengembalikan sertifikat yang telah habis masa berlakunya,
                sertifikat yang ditarik atau dibatalkan. Hak penyimpanan secara khusus dikecualikan;</li>
            <li>Tata cara penggunaan logo sertifikasi dan/atau sertifikasi akan diberikan pada
                dokumen terpisah kepada Klien yang telah tersertifikasi.</li>
        </ul>

        <h6>5.2 SERTIFIKAT YANG TIDAK DITERBITKAN</h6>
        <ul>
            <li>SIS hanya menerbitkan sertifikat jika semua persyaratan dari standar yang dipilih,
                spesifikasi dan kontrak telah dipenuhi setelah audit (awal/resertifikasi);</li>
            <li>Jika tidak terpenuhi, maka auditor mendokumentasikan kekurangannya di dalam
                laporan ketidaksesuaian dan/atau mengidentifikasi hambatan yang harus dipatuhi
                agar sertifikat dapat diterbitkan;</li>
            <li>Semua ketidaksesuaian harus diselesaikan sebelum penerbitan sertifikat SIS. Jika
                perlu, SIS akan mengulang audit secara sebagian atau penuh;</li>
            <li>Jika ketidaksesuaian belum dihilangkan atau jika prasyarat untuk pemberian sertifikat
                belum dicapai bahkan setelah audit lanjutan, prosedur sertifikasi akan diakhiri dengan
                penerbitan laporan tanpa sertifikat.</li>
        </ul>

        <h6>5.3 PEMBEKUAN, PENARIKAN DAN PEMBATALAN SERTIFIKAT</h6>
        <h6>PEMBEKUAN</h6>
        <ul>
            <li>SIS berhak untuk membekukan sementara sertifikat jika klien melanggar persyaratan sertifikasi, kewajiban
                kontrak atau financial kepada SIS</li>
            <li>Pembekuan sertifikasi dapat terjadi apabila terdapat satu kasus atau lebih dibawah ini:</li>
            <div class="form-group">
                <ol type=1>
                    <li>Sistem manajemen klien gagal secara total dan serius untuk memenuhi persyaratan sertifikasi
                        termasuk
                        persyaratan untuk efektifitas sistem manajemen; </li>
                    <li>klien tidak memperbolehkan adanya audit survailen atau resertifikasi pada
                        frekwensi yang dipersyaratkan;</li>
                    <li>SIS tidak diinformasikan secara tepat waktu tentang perubahan yang direncanakan terhadap sistem
                        manajemen dan perubahan lainnya yang mempengaruhi
                        kesesuaian sistem dengan standar atau spesifikasi yang menjadi acuan audit;</li>
                    <li>Sertifikat SIS, atau logo sertifikat telah digunakan dengan cara yang menyesatkan atau tidak sah
                    </li>
                    <li>Pemegang sertifikat meminta pembekuan secara sukarela;</li>
                    <li>Pembayaran untuk jasa audit dan sertifikasi belum dilakukan secara tepat waktu
                        setelah setidaknya satu peringatan tertulis.</li>
                </ol>
            </div>
            <li>SIS akan memberitahu klien tetang pembekuan ini dalam bentuk tertulis;</li>
            <li>Jika penyebab dari pembekuan ini tidak dihilangkan, maka SIS akan menginformasikan secara tertulis
                kepada
                klien mengenai pembekuan Sertifikat dengan menyatakan alasannya serta tindakan perbaikan yang diperlukan
                agar sertifikat bisa kembali;</li>
            <li>Pembekuan Sertifikat dilakukan dalam periode waktu tertentu (maksimum 6 bulan);</li>
            <li>Jika tindakan yang diperlukan telah terbukti diimplementasikan secara efektif dengan
                batas waktu yang ditetapkan, pembekuan sertifikat dibatalkan;
            </li>
            <li>Jika tindakan yang diperlukan belum diimplementasikan dalam waktu yang telah
                ditentukan, Sakti Indonesia Sertifikasi dapat menarik sertifikat sebagaimana diatur di
                bawah ini;</li>
            <li>Dalam kondisi pembekuan, pemegang sertifikat tidak diperbolehkan untuk menggunakan sertifikat dan logo
                Sakti
                Indonesia Sertifikasi untuk keperluan promosinya
                lebih lanjut dan mengadakan tindakan yang sesuai. Status pembekuan sertifikasi
                dapat diakses publik.</li>
        </ul>

        <h6>PENCABUTAN</h6>
        <ul>
            <li>SIS berhak menarik sertifikat atau menyatakan tidak sah dengan pemberitahuan
                tertulis kepada Klien jika:</li>
            <div class="form-group">
                <ol type=1>
                    <li>Masa pembekuan sertifikat telah terlewati; </li>
                    <li>Kesesuaian sistem manajemen berdasarkan standar atau spesifikasinya tidak
                        dapat dipastikan atau Klien tidak mau atau tidak dapat menghilangkan ketidaksesuaian;</li>
                    <li>Klien terus menerus menggunakan sertifikat sebagai promosi setelah sertifikat
                        dibekukan;</li>
                    <li>Klien menggunakan sertifikat sedemikian rupa untuk merusak reputasi SIS;
                    </li>
                    <li>Prasyarat yang menyebabkan menerbitkan sertifikat tidak berlaku lagi;</li>
                    <li>Klien mengajukan permohonan sukarela atau tidak sukarela dalam hal
                        kebangkrutan;</li>
                    <li>Klien secara efektif memutuskan hubungan kontrak dengan SIS.</li>
                </ol>
            </div>
            <li>Sertifikasi dicabut apabila kondisi seperti yang dijelaskan pada butir pembekuan
                sertifikat diatas tidak diperbaiki dalam batas waktu yang telah ditetapkan;</li>
            <li>Klien diinformasikan atas keputusan pencabutan sertifikasinya dan kepada klien
                tersebut diperingatkan untuk tidak melanjutkan penggunaan sertifikat dan logo SIS
                dalam bentuk dan kondisi apapun;</li>
            <li>Segala dokumen dan rekaman yang terkait dengan klien tersebut ditiadakan dari
                daftar klien dan status pencabutan ini dapat diakses oleh pihak tertentu apabila
                diperlukan;</li>
            <li>Segala dokumen dan rekaman yang terkait di keluarkan dari skema sertifikasi;</li>
            <li>Klien yang mengajukan pengunduran diri/pemberhentian kerja sama sertifikasi maka
                prosesnya merujuk pada QP-CER-07;</li>
            <li>Klien yang mengajukan pengunduran diri/pemberhentian kerja sama sertifikasi, dikenakan kewajiban untuk
                membayar biaya sebesar 50% dari biaya surveilance I/II.
            </li>
        </ul>

        <h6>PEMBATALAN</h6>
        <ul>
            <li>SIS berhak membatalkan sertifikat, atau secara retroaktif menyatakan tidak sah jika:</li>
            <div class="form-group">
                <ol type=1>
                    <li>Ternyata prasyarat-² yang diperlukan dalam menerbitkan sertifikat pada
                        kenyataannya tidak terpenuhi;</li>
                    <li>Klien telah membahayakan prosedur sertifikasi sehingga obyektivitas, netralitas
                        atau independensi hasil audit yang diputuskan oleh Sakti Indonesia Sertifikasi
                        dipertanyakan.</li>
                </ol>
            </div>
        </ul>

        <h6>5.4 PENGURANGAN & PENAMBAHAN LINGKUP SERTIFIKASI</h6>
        <h6>PENGURANGAN LINGKUP</h6>
        <ul>
            <li>Ruang lingkup sertifikasi yang telah diberikan dapat berkurang apabila terjadi kondisi
                berikut ini:</li>
            <div class="form-group">
                <ol type=1>
                    <li>Karena terjadi kasus seperti yang diuraikan dalam diatas;</li>
                    <li>Klien dinilai tidak berhasil memperbaiki kekurangan yang terjadi pada lingkup
                        yang terkait;</li>
                    <li>Pengurangan ruang lingkup sertifikasi berdasarkan permintaan pemegang
                        sertifikat.</li>
                </ol>
            </div>
            <li>Apabila klien menghendaki pengurangan ruang lingkup sertifikasi dari lingkup yang
                telah diberikan, klien harus menginformasikan hal ini dengan jelas kepada
                manajemen SIS mengenai permintaan pengurangan ruang lingkup sertifikasi tersebut
                dan dengan alasan yang jelas.</li>
        </ul>

        <h6>PENAMBAHAN LINGKUP</h6>
        <ul>
            <li>Klien diperbolehkan untuk mengajukan penambahan lingkup sertifikasi. Penambahan lingkup sertifikasi
                diajukan
                ke
                SIS kapan saja selama sertifikat masih berlaku dan
                dilakukan audit oleh tim auditor ke lokasi sesuai dengan rencana audit untuk lingkup
                sertifikasi yang ditambahkan;</li>
            <li>Pelaksanaan audit penambahan lingkup sertifikasi dapat bersamaan dengan
                pelaksanaan audit survailen;</li>
            <li>Penambahan lingkup sertifikasi akan diberikan, apabila hasil evaluasi memutuskan
                untuk diberikan penambahan lingkup sertifikasi tersebut.</li>
        </ul>
        <h6>PEMBERITAHUAN PERUBAHAN</h6>
        <ul>
            <li>SIS akan memberikan informasi kepada klien yang disertifikasi setiap perubahan
                persyaratan sertifikasi, dan akan melakukan verifikasi untuk memastikan bahwa
                setiap klien yang disertifikasi memenuhi persyaratan baru tersebut.</li>
        </ul>
    </div>

    <div class="form-group" style="text-align:justify">
        <h6>6. PERSETUJUAN PERJANJIAN SERTIFIKASI</h6>
        <label for="">Demikianlah kontrak sertifikasi ini ini dibuat untuk di ketahui oleh kedua belah PIHAK
            mengenai peraturan kerjasama.</label>
        <div class="form-group">
            <ol type=1>
                <li>Kami mengkonfirmasikan bahwa informasi yang diberikan adalah benar, akurat dan
                    kami setuju untuk membayar semua biaya seperti dinyatakan dalam proposal ini;</li>
                <li>Kami setuju dengan Kontrak Sertifikasi yang telah ditetapkan PT Sakti Indonesia
                    Sertifikasi.</li>

            </ol>
        </div>
        <div class="row mb-5">
            <label for="">Kontrak Sertifikasi ini dibuat dalam rangkap dua yang bermaterai dan mempunyai
                kekuatan
                yang sama.</label>
        </div>
    </div>
    <table>
        <tbody>
            <tr>
                <td>Surabaya,..............</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>PT SAKTI Indonesia Sertifikasi</strong></td>
                <td></td>
                <td style="text-align: center">.........................................................</td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <h1></h1>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>(................................)</td>
                <td></td>
                <td style="text-align: center">(................................)</td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
