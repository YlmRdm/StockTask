INSERT INTO `Error` (`code`, `msg`) VALUES 
(0, 'success'),
(201, 'Limited success. One or more batch requests failed for the command executed.'),
(204, 'The request was successful, but the result is empty.'),
(400, 'Bad Request. One or more required parameters were missing or invalid'),
(401, 'Forbidden. User does not exist.'),
(402, 'Forbidden. Authorization token does not exist.'),
(403, 'Forbidden. Request is missing valid credentials.'),
(405, 'Method not allowed. The method specified in the Request-Line is not allowed for the resource identified by the Request-URI.'),
(500, 'Internal Server Error. The server encountered an unexpected condition which prevented it from fulfilling the request.');