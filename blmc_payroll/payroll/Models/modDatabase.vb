Imports System.Reflection
Imports MySql.Data.MySqlClient

Module modDatabase
    Public dbconn As New MySqlConnection
    Public sql As String
    Public dbcomm As New MySqlCommand
    Public dbread As MySqlDataReader
    Public employeeName As String
    Public employeeId As Integer
    Public employeeNo As String

    Private DB_HOST = "localhost"
    Private DB_USER = "root"
    Private DB_PASSWORD = ""
    Private DB_NAME = "payroll"
    Private DB_PORT = "3306"

    Public Sub dbConnect()
        dbconn = New MySqlConnection("Data Source=" + DB_HOST + ";user id=" + DB_USER + ";password=" + DB_PASSWORD + ";port=" + DB_PORT + ";database=" + DB_NAME)
        Try
            dbconn.Open()
        Catch ex As Exception
            MsgBox("Connection Error: " & ex.Message.ToString)
        End Try
    End Sub


    Public Function checkAttendance(time_date As String, employee_id As String)

        sql = "select * from attendances where employee_id = '" + employee_id + "' and date = '" + time_date + "' "
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If dbcomm.ExecuteScalar <> 0 Then
                Return True

            Else
                Return False
            End If
        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()
    End Function


    Public Function checkTimeout(time_date As String, employee_id As String)

        sql = "select * from attendances where employee_id = '" + employee_id + "' and date = '" + time_date + "' and time_out = NULL "
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If dbcomm.ExecuteScalar <> 0 Then
                Return True

            Else
                Return False
            End If
        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()
    End Function

    Public Function setting(name As String)

        sql = "select * from settings where " + name + " "
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If dbcomm.ExecuteScalar > 0 Then
                dbread.Read()

                Return dbread!value


            End If
        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()
    End Function

    Public Function attendance_timeIn(time_date As String, employee_id As String, ontime_status As String)


        sql = "select * from attendances where employee_id = '" + employee_id + "' and date = '" + time_date + "' "
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If dbcomm.ExecuteScalar <> 0 Then
                MessageBox.Show("Already timed in!")
                Return True

            Else



                sql = "INSERT INTO attendances (date,time_in,num_hour,employee_id,ontime_status) VALUES('" & time_date & "','" & TimeOfDay.ToString("hh:mm:ss") & "','" & 0 & "','" & employee_id & "','" & ontime_status.ToString() & "')"
                Try
                    dbcomm = New MySqlCommand(sql, dbconn)
                    dbread = dbcomm.ExecuteReader()
                    dbread.Close()

                Catch ex As Exception
                    MsgBox("Error: " & ex.Message.ToString())
                End Try
                dbread.Close()
                Return False
            End If


        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()


    End Function

    Public Sub attendance_timeOut(time_date As String, employee_id As String)


        sql = "select * from attendances where employee_id = '" & employee_id & "' and date = '" & time_date & "' "
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If (dbcomm.ExecuteScalar > 0) Then
                MessageBox.Show("timeout " + employee_id + " " + time_date)
                sql = "update attendances set time_out='" & TimeOfDay.ToString("HH:mm:ss") & "'  where employee_id = '" & employee_id & "' and date = '" & time_date & "' "
                Try
                    dbcomm = New MySqlCommand(sql, dbconn)
                    dbread = dbcomm.ExecuteReader()
                    dbread.Close()

                Catch ex As Exception
                    MsgBox("Error: " & ex.Message.ToString())
                End Try
                dbread.Close()


            End If


        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()


    End Sub


    Public Sub login_success()
        My.Computer.Audio.Play(System.AppDomain.CurrentDomain.BaseDirectory & "audio\success.wav",
        AudioPlayMode.WaitToComplete)
    End Sub

    Public Sub login_error()
        My.Computer.Audio.Play(System.AppDomain.CurrentDomain.BaseDirectory & "audio\error.wav",
        AudioPlayMode.WaitToComplete)
    End Sub

    Public Function checkEmployee(employee_id As String)
        sql = "select * from employees where employee_id = '" + employee_id + "'"
        Try
            dbcomm.CommandText = sql
            dbcomm.Connection = dbconn
            dbread = dbcomm.ExecuteReader


            If (dbread.Read) Then
                employeeName = dbread.GetString(3) & " " & dbread.GetString(2)
                employeeId = dbread.GetString(0)
                employeeNo = dbread.GetString(1)
                dbread.Close()
                Return True
            Else
                dbread.Close()
                Return False
            End If


        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()

    End Function
    Public Function checkFingerprint(employee_id As String, finger As String, first_name As String, last_name As String)
        sql = "select * from finger_prints where employee_id = '" + employee_id + "'"
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            If (dbcomm.ExecuteScalar > 0) Then
                Return True
            Else
                createFingerprint(employee_id, finger, first_name, last_name)
                Return False
            End If


        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()

    End Function


    Public Sub createFingerprint(employee_id As String, finger As String,first_name As String, last_name As String)
        sql = "INSERT INTO finger_prints(employee_id,finger) VALUES('" + employee_id + "','" + finger + "')"
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

            createEmployee(employee_id, first_name, last_name)
        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()
    End Sub

    Public Sub createEmployee(employee_id As String, first_name As String, last_name As String)
        sql = "INSERT INTO employees(employee_id,first_name,last_name) VALUES('" + employee_id + "','" + first_name + "','" + last_name + "')"
        Try
            dbcomm = New MySqlCommand(sql, dbconn)
            dbread = dbcomm.ExecuteReader()
            dbread.Close()

        Catch ex As Exception
            MsgBox("Error: " & ex.Message.ToString())
        End Try
        dbread.Close()
    End Sub

    Public Sub logout()

    End Sub



    Public Sub dbOpen()
        dbconn.Open()
    End Sub
End Module
