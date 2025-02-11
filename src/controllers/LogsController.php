<?php

require_once __DIR__ . '/../repository/LogsRepository.php';


class LogsController extends AppController
{
    public function reviewLogs()
    {
        if (!$this->isPost()) {
            return $this->render('review_logs');
        }

        if (!isset($_GET['userID']) || empty($_GET['userID'])) {
            return $this->render('error', ['messages' => ['User ID is missing.']]);
        }

        $userID = $_GET['userID'];

        $reviewLogRepository = new LogsRepository();
        $logs = $reviewLogRepository->getReviewLogsByUserID($userID);

        if ($logs) {
            return $this->render('review_logs', ['review_logs' => $logs, 'userID' => $userID]);
        } else {
            return $this->render('error', ['messages' => ['No logs found for this user.']]);
        }
    }
}