<?php
$displayedPrograms = [];
foreach ($program as $row):
    // Check if the program has already been displayed
    if (!in_array($row->nama_programkm, $displayedPrograms)) {
        // Add the program name to the displayed array
        $displayedPrograms[] = $row->nama_programkm;
?>
        <div class="card">
            <div class="card-header bg-primary text-center text-white text-xs font-weight-bold text-uppercase mb-1" data-toggle="collapse" data-target="#program_km_<?= $row->id_programkm ?>">
                <?= $row->nama_programkm ?>
            </div>
            <div class="collapse" id="program_km_<?= $row->id_programkm ?>">
                <?php if (isset($row->nama_instansi)) { ?>
                    <div class="card">
                        <div class="card-header bg-primary text-center text-white text-xs font-weight-bold text-uppercase mb-1" data-toggle="collapse" data-target="#instansi_<?= $row->id_instansi ?>">
                            <?= $row->nama_instansi ?>
                        </div>
                        <div class="collapse" id="instansi_<?= $row->id_instansi ?>">
                            <?php
                            // Group logbooks by student
                            $students = [];
                            foreach ($program as $innerRow) {
                                if ($innerRow->nama_programkm === $row->nama_programkm && $innerRow->nama_instansi === $row->nama_instansi) {
                                    if (!isset($students[$innerRow->id_mahasiswa])) {
                                        $students[$innerRow->id_mahasiswa] = [
                                            'nama' => $innerRow->nama_mahasiswa,
                                            'logbooks' => []
                                        ];
                                    }
                                    // Add logbook if it exists
                                    if (isset($innerRow->id_logbook)) {
                                        $students[$innerRow->id_mahasiswa]['logbooks'][] = $innerRow;
                                    }
                                }
                            }
                            // Tampilan Logbook
                            foreach ($students as $studentId => $student) {
                                if (isset($student['nama'])) { ?>
                                    <div class="card">
                                        <div class="card-header bg-primary text-center text-white text-xs font-weight-bold text-uppercase mb-1" data-toggle="collapse" data-target="#mahasiswa_<?= $studentId ?>">
                                            <?= $student['nama'] ?>
                                        </div>
                                        <div class="collapse" id="mahasiswa_<?= $studentId ?>">
                                            <?php
                                            $logbookCounter = 1;
                                            foreach ($student['logbooks'] as $logbook) { ?>
                                                <div class="card">
                                                    <div class="card-header bg-primary text-center text-white text-xs font-weight-bold text-uppercase mb-1" data-toggle="collapse" data-target="#logbook_<?= $logbook->id_logbook ?>">
                                                        <?= $logbook->tipe_laporan ?>
                                                    </div>
                                                    <div class="collapse" id="logbook_<?= $logbook->id_logbook ?>">
                                                        <p>Status Logbook: <?= $logbook->status ?></p>
                                                        <p>Tipe Laporan: <?= $logbook->tipe_laporan ?></p>
                                                        <p>Uraian Kegiatan:
                                                            <?php if ($logbook->tipe_laporan == 'Laporan Akhir'): ?>
                                                                <a href="<?= base_url('assets/template/file/') . $logbook->uraian_kegiatan ?>" target="_blank"><?= $logbook->uraian_kegiatan ?></a>
                                                            <?php else: ?>
                                                                <?= $logbook->uraian_kegiatan ?>
                                                            <?php endif; ?>
                                                        </p>
                                                        <p>Tanggal: <?= $logbook->tanggal ?></p>
                                                        <p>Tanggal Upload: <?= $logbook->tanggal_upload ?></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
<?php }
endforeach; ?>