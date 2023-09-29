Imports System.Windows.Forms.VisualStyles.VisualStyleElement

Public Class login

    Implements DPFP.Capture.EventHandler
    Delegate Sub FunctionCall(ByVal param)
    Private Capturer As DPFP.Capture.Capture
    Private Verificator As DPFP.Verification.Verification
    Private Template As DPFP.Template
    Private tttemplate As List(Of DPFP.Template)


    Protected Overridable Sub Init()
        Try
            Timer1.Start()
            Capturer = New DPFP.Capture.Capture()                   ' Create a capture operation.
            Verificator = New DPFP.Verification.Verification()

            If (Not Capturer Is Nothing) Then
                Capturer.EventHandler = Me                              ' Subscribe for capturing events.
            Else

            End If

        Catch ex As DPFP.Error.SDKException
            ' MessageBox.Show("Can't initiate capture operation!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            MsgBox(ex.ToString, MsgBoxStyle.Exclamation, "BLMC")
        End Try
    End Sub

    Protected Overridable Sub Processs(ByVal Sample As DPFP.Sample)
        DrawPicture(ConvertSampleToBitmap(Sample))
    End Sub

    Protected Function ConvertSampleToBitmap(ByVal Sample As DPFP.Sample) As Bitmap
        Dim convertor As New DPFP.Capture.SampleConversion()  ' Create a sample convertor.
        Dim bitmap As Bitmap = Nothing              ' TODO: the size doesn't matter
        convertor.ConvertToPicture(Sample, bitmap)


        ' TODO: return bitmap as a result
        Return bitmap
    End Function

    Protected Function ExtractFeatures(ByVal Sample As DPFP.Sample, ByVal Purpose As DPFP.Processing.DataPurpose) As DPFP.FeatureSet
        Dim extractor As New DPFP.Processing.FeatureExtraction()    ' Create a feature extractor
        Dim feedback As DPFP.Capture.CaptureFeedback = DPFP.Capture.CaptureFeedback.None
        Dim features As New DPFP.FeatureSet()
        extractor.CreateFeatureSet(Sample, Purpose, feedback, features) ' TODO: return features as a result?
        If (feedback = DPFP.Capture.CaptureFeedback.Good) Then
            Return features
        Else
            Return Nothing
        End If
    End Function

    Public Sub StartCapture()
        If (Not Capturer Is Nothing) Then
            Try
                Capturer.StartCapture()

            Catch ex As DPFP.Error.SDKException
                'SetPrompt("Can't initiate capture!")
                MsgBox(ex.ToString, MsgBoxStyle.Exclamation, "XTech")
            End Try
        End If
    End Sub

    Protected Sub StopCapture()
        If (Not Capturer Is Nothing) Then
            Try
                Capturer.StopCapture()
            Catch ex As Exception

            End Try
        End If
    End Sub

    Private Sub CaptureForm_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Init()
        StartCapture()

        Control.CheckForIllegalCrossThreadCalls = False
        Call dbConnect()

        If TimeOfDay.Hour > 12 Then
            txtToday.Text = "Good Afternoon"
        ElseIf TimeOfDay.Hour < 9 Then
            txtToday.Text = "Good Morning"
        End If

        Dim SAPI
        SAPI = CreateObject("SAPI.spvoice")
        SAPI.Speak(txtToday.Text)



    End Sub

    Private Sub CaptureForm_FormClosed(ByVal sender As System.Object, ByVal e As System.Windows.Forms.FormClosedEventArgs) Handles MyBase.FormClosed
        StopCapture()
    End Sub

    Sub OnReaderDisconnect(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnReaderDisconnect

    End Sub

    Sub OnSampleQuality(ByVal Capture As Object, ByVal ReaderSerialNumber As String, ByVal CaptureFeedback As DPFP.Capture.CaptureFeedback) Implements DPFP.Capture.EventHandler.OnSampleQuality
        If CaptureFeedback = DPFP.Capture.CaptureFeedback.Good Then
            'MakeReport("The quality of the fingerprint sample is good.")
        Else
            'MakeReport("The quality of the fingerprint sample is poor.")
        End If
    End Sub

    Sub OnComplete(ByVal Capture As Object, ByVal ReaderSerialNumber As String, ByVal Sample As DPFP.Sample) Implements DPFP.Capture.EventHandler.OnComplete

        Process(Sample)
    End Sub

    Sub OnFingerGone(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnFingerGone

    End Sub

    Sub OnFingerTouch(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnFingerTouch

    End Sub

    Sub OnReaderConnect(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnReaderConnect

    End Sub

    Protected Sub SetStatus(ByVal status)

    End Sub

    Protected Sub DrawPicture(ByVal bmp)

        Invoke(New FunctionCall(AddressOf _DrawPicture), bmp)

    End Sub

    Private Sub _DrawPicture(ByVal bmp)
        Picture.Image = New Bitmap(bmp, Picture.Size)
        ' My.Computer.Audio.Play(My.Resources.Single_wave, AudioPlayMode.Background)
    End Sub


    Protected Sub Process(ByVal Sample As DPFP.Sample)

        Processs(Sample)

        Dim day As String = Format(Today, "dddd")
        Dim time As Date
        Dim CurrHour As Integer
        Dim CurrMinute As Integer
        Dim CurrSecond As Integer
        Dim timeIn As String
        Dim timeInStatus As String

        Dim fullpath As String
        Dim checkExistence As Boolean

        Dim SAPI
        SAPI = CreateObject("SAPI.spvoice")

        fullpath = Application.StartupPath & "\Enrolled_Fingers\"
        'fullpath = ""
        Dim FileDirectory As New IO.DirectoryInfo(fullpath)
        Dim FileJpg As IO.FileInfo() = FileDirectory.GetFiles("*.fpt")
        ProgressBar1.Minimum = 0
        ProgressBar1.Value = 0
        ProgressBar1.Maximum = FileDirectory.GetFiles("*.fpt").Count

        If ProgressBar1.Maximum = 0 Then
            MsgBox("No Persons have enrolled", MsgBoxStyle.Exclamation, "BLMC")
            Exit Sub
        End If

        Invoke(New FunctionCall(AddressOf cleartxtbox), "")

        ' Process the sample and create a feature set for the enrollment purpose.
        Dim features As DPFP.FeatureSet = ExtractFeatures(Sample, DPFP.Processing.DataPurpose.Verification)

        ' Check quality of the sample and start verification if it's good
        If Not features Is Nothing Then
            ' Compare the feature set with our template

            For Each File As IO.FileInfo In FileJpg
                ProgressBar1.Value += 1
                Using fs As IO.FileStream = IO.File.OpenRead(File.FullName)
                    Dim hello As New DPFP.Template(fs)

                    Dim result As DPFP.Verification.Verification.Result = New DPFP.Verification.Verification.Result()
                    Verificator.Verify(features, hello, result)
                    'UpdateStatus(result.FARAchieved)
                    If result.Verified Then

                        Dim name As String = System.IO.Path.GetFileNameWithoutExtension(File.FullName)

                        autoselect(name)

                        time = DateTime.Now

                        CurrHour = time.Hour
                        CurrMinute = time.Minute
                        CurrSecond = time.Second

                        checkExistence = checkEmployee(name)
                        If checkExistence = True Then




                            If CurrHour > 7.25 AndAlso CurrHour <= 15 Then
                                timeInStatus = "late"
                            Else
                                timeInStatus = "on-time"
                            End If



                            If CurrHour < 15 Then

                                If checkAttendance(Today.Date.ToString("yyyy-MM-dd"), employeeId) = False Then
                                    Timer2.Enabled = True
                                    Timer2.Start()

                                    Label1.Text = "Match Found"

                                    TextBox1.Text = employeeName
                                    SAPI.Speak("Thank you " & employeeName & "!")
                                    timeIn = CurrHour & ":" & CurrMinute & ":" & CurrSecond

                                    Call attendance_timeIn(Today.Date.ToString("yyyy-MM-dd"), employeeId, timeInStatus)
                                Else
                                    MessageBox.Show("Already logged in: You are not allowed to login multiple times!")
                                End If

                            End If

                            If CurrHour > 15 Then
                                If checkTimeout(Today.Date.ToString("yyyy-MM-dd"), employeeId) = True Then
                                    Call attendance_timeOut(Today.Date.ToString("yyyy-MM-dd"), employeeId)
                                Else
                                    MessageBox.Show("Already logged out:You are not allowed to logout multiple times! ")
                                End If

                            End If



                            ' login_success()

                        Else
                            MessageBox.Show("You are not enrolled in our records yet!")
                        End If


                        Exit For
                    Else
                        Label1.Text = "Match Not Found"
                        TextBox1.Text = ""
                        ' login_error()
                        'MakeReport("The fingerprint was NOT VERIFIED.")
                        ' Invoke(New FunctionCall(AddressOf picturenotvieried), My.Resources.Boton_mal)
                        lblLoading.Text = "Undefined fingerprint!"
                    End If

                End Using
            Next
        End If
    End Sub


    Sub autoselect(ByVal identity As String)



        Picture.Image = Nothing

        Try
            Picture.Image = Image.FromFile(Application.StartupPath & "\Enrolled_faces\" & identity & ".jpg")
        Catch ex As Exception

        End Try

        Invoke(New FunctionCall(AddressOf _setname), identity)
        Exit Sub

    End Sub

    Sub cleartxtbox(ByVal clearr As String)
        TextBox1.Text = ""
    End Sub

    Private Sub _setname(ByVal setname As String)
        Try
            TextBox1.Text = setname
            ProgressBar1.Value = 0

            imgFinger.Visible = False

            ' MsgBox("Welcome " & TextBox1.Text & ", You just logged In.")
            lblTime.Text = TimeOfDay
            lblDate.Text = Today
            'Me.Hide()
            ' welcome.ShowDialog()



            ProgressBar1.Minimum = 0
            ProgressBar1.Maximum = 100

        Catch ex As Exception

        End Try

    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Form1.Close()
        StopCapture()
        Form1.ShowDialog()
    End Sub

    Private Sub Timer1_Tick(sender As Object, e As EventArgs) Handles Timer1.Tick
        lblToday.Text = TimeOfDay + " " + Today
    End Sub

    Private Sub Timer2_Tick(sender As Object, e As EventArgs) Handles Timer2.Tick



        ProgressBar1.Value = ProgressBar1.Value + 10
            ProgressBar1.Visible = True
            lblLoading.Text = ProgressBar1.Value & " % " & " completed"

            If ProgressBar1.Value >= 100 Then
                Timer2.Enabled = False
                ProgressBar1.Value = 0
                lblLoading.Text = "Time-in was successful!"
                If ProgressBar1.Value = 0 Then
                    ProgressBar1.Visible = False

                End If
            End If


    End Sub

    Private Sub login_Resize(sender As Object, e As EventArgs) Handles Me.Resize
        Me.Panel2.Location = New Point(Convert.ToInt32(Me.ClientSize.Width / 2 - Me.Panel2.Width / 2),
                                 Convert.ToInt32(Me.ClientSize.Height / 2 - Me.Panel2.Height / 2))


    End Sub

    Private Sub Label5_Click(sender As Object, e As EventArgs) Handles txtToday.Click

    End Sub

    Private Sub Panel2_Paint(sender As Object, e As PaintEventArgs) Handles Panel2.Paint

    End Sub
End Class
